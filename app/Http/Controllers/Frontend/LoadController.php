<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Service;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Mail\ReservationConfirmation;
use Illuminate\Support\Facades\DB;

use App\Mail\ReservationNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class LoadController extends Controller
{




   public function index()
    {

$services1 = Service::where('is_active', true)
                   ->orderBy('id', 'desc')
                   ->get();

                   $services = Service::orderBy('id', 'desc')
                   ->get();



$testimonials = Testimonial::where('is_active', true)
                   ->orderBy('id', 'desc')
                   ->get();


        return view('frontend.index',compact('services','testimonials','services1'));
    }






       public function reservationStore(Request $request)
{

    try {
        // Validate first
        $request->validate([
            'service_id'        => 'required|exists:services,id',
            'datetime'       => 'required|date_format:Y-m-d\TH:i',
            'name'           => 'required|string|max:100',
            'phone'          => 'required|digits_between:7,11',
            'email'          => 'required|email|max:255',
            'other_request'  => 'nullable|string|max:1000',
        ]);

        // Ensure the selected time is on a 30-minute interval (minutes == 00 or 30)
        // Use Carbon with Japan timezone for all date/time operations
        $japanTz = 'Asia/Tokyo';
        $reservationDt = Carbon::createFromFormat('Y-m-d\TH:i', $request->datetime, $japanTz);
        $nowJapan = Carbon::now($japanTz);

        $minutes = $reservationDt->format('i');
        if (!in_array($minutes, ['00', '30'])) {
            throw ValidationException::withMessages([
                'datetime' => ['時間は30分刻みで選択してください（00または30分）'],
            ]);
        }

        // Split datetime to date + time
        $date = $reservationDt->format('Y-m-d');
        $time = $reservationDt->format('H:i');

        // Validate not on closed days (Monday=1, Thursday=4)
        $dayOfWeek = $reservationDt->dayOfWeekIso; // 1=Monday, 7=Sunday
        if (in_array($dayOfWeek, [1, 4])) {
            throw ValidationException::withMessages([
                'datetime' => ['月曜日と木曜日は定休日です。'],
            ]);
        }

        // Validate not in the past (Japan time)
        if ($reservationDt->lte($nowJapan)) {
            throw ValidationException::withMessages([
                'datetime' => ['過去の日時は選択できません。'],
            ]);
        }

        // Validate business hours (10:30 - 18:30)
        $timeInMinutes = $reservationDt->hour * 60 + $reservationDt->minute;
        if ($timeInMinutes < 630 || $timeInMinutes > 1110) { // 10:30 = 630, 18:30 = 1110
            throw ValidationException::withMessages([
                'datetime' => ['営業時間は10:30〜18:30です。'],
            ]);
        }

        // Use database transaction with locking to prevent race conditions
        $reservation = DB::transaction(function () use ($date, $time, $request) {
            // Check if slot is already fully booked (max 2 per slot)
            // lockForUpdate() prevents other transactions from reading until this completes
            $existingCount = Reservation::where('date', $date)
                ->where('time', $time)
                ->lockForUpdate()
                ->count();
            if ($existingCount >= 2) {
                throw ValidationException::withMessages([
                    'datetime' => ['この時間帯は満席です。別の時間をお選びください。'],
                ]);
            }

            return Reservation::create([
                'service_id'     => $request->service_id,
                'date'           => $date,
                'time'           => $time,
                'name'           => $request->name,
                'phone'          => $request->phone,
                'email'          => $request->email,
                'other_request'  => $request->other_request,
            ]);
        });

        // Send confirmation email to customer
        Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));

        // Send notification email to admin
        Mail::to(config('app.admin_email'))->send(new ReservationNotification($reservation));

        return back()->with('success', 'ご予約が完了しました！');

    } catch (ValidationException $e) {
        return back()->withErrors($e->errors())->withInput()->with('scroll', 'message');
    } catch (\Exception $e) {
        \Log::error('Reservation error: ' . $e->getMessage());
        return back()->with('error', '予約の処理中にエラーが発生しました。もう一度お試しください。')->withInput();
    }
}



public function getReservationsByDate(Request $request)
{
    $date = $request->date;

    // Business hours in minutes (10:30 = 630, 18:30 = 1110)
    $businessStart = 630;  // 10:30
    $businessEnd = 1110;   // 18:30

    // Get reservation counts grouped by time
    $reservations = Reservation::where('date', $date)
        ->select('time', DB::raw('count(*) as total'))
        ->groupBy('time')
        ->pluck('total', 'time');

    // Get ALL reservation times for this date (including duplicates for proximity check)
    // We need individual reservation times, not unique ones
    $allTimes = Reservation::where('date', $date)
        ->pluck('time')
        ->map(function ($time) {
            // Convert time to minutes for easier calculation
            $parts = explode(':', $time);
            return (int)$parts[0] * 60 + (int)$parts[1];
        })
        ->sort()
        ->values()
        ->toArray();

    // Find groups of reservations within 1 hour (60 minutes) of each other
    // Check ALL pairs of reservations (not unique times)
    $proximityBlocks = [];
    $n = count($allTimes);
    
    if ($n >= 2) {
        $processed = []; // Track which ranges we've already added
        
        // Check every pair of reservations
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                // Check if these two reservations are within 60 minutes of each other
                // (includes same time slot - difference would be 0)
                if ($allTimes[$j] - $allTimes[$i] <= 60) {
                    // Calculate block range: from first reservation to (last + 1 hour)
                    $blockStart = max($allTimes[$i], $businessStart);
                    $blockEnd = min($allTimes[$j] + 60, $businessEnd);
                    
                    // Create a key to avoid duplicate ranges
                    $key = $blockStart . '-' . $blockEnd;
                    if (!isset($processed[$key])) {
                        $proximityBlocks[] = [
                            'start' => $blockStart,
                            'end' => $blockEnd
                        ];
                        $processed[$key] = true;
                    }
                }
            }
        }
        
        // Merge overlapping blocks
        if (count($proximityBlocks) > 1) {
            usort($proximityBlocks, fn($a, $b) => $a['start'] - $b['start']);
            $merged = [$proximityBlocks[0]];
            
            for ($i = 1; $i < count($proximityBlocks); $i++) {
                $last = &$merged[count($merged) - 1];
                if ($proximityBlocks[$i]['start'] <= $last['end']) {
                    // Overlapping, merge them
                    $last['end'] = max($last['end'], $proximityBlocks[$i]['end']);
                } else {
                    $merged[] = $proximityBlocks[$i];
                }
            }
            $proximityBlocks = $merged;
        }
    }

    return response()->json([
        'reservations' => $reservations,
        'proximityBlocks' => $proximityBlocks
    ]);
}

}
