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

    // Map of counts per time (for "same time reserved twice" rule)
    $reservations = Reservation::where('date', $date)
        ->select('time', DB::raw('count(*) as total'))
        ->groupBy('time')
        ->pluck('total', 'time');

    // Unique reservation times for chain detection (in minutes)
    $uniqueTimes = collect($reservations)
        ->keys()
        ->map(function ($time) {
            [$h, $m] = array_map('intval', explode(':', $time));
            return $h * 60 + $m;
        })
        ->sort()
        ->values()
        ->toArray();

    $proximityBlocks = [];

    // Helper to push a clamped block
    $pushBlock = function (int $startMin, int $endMin) use (&$proximityBlocks, $businessStart, $businessEnd) {
        $start = max($startMin, $businessStart);
        $end = min($endMin, $businessEnd);
        if ($start < $end) {
            $proximityBlocks[] = ['start' => $start, 'end' => $end];
        }
    };

    // Validation 02 – Same Time Reserved Twice → block ±1 hour around that time
    foreach ($reservations as $timeStr => $count) {
        if ($count >= 2) {
            [$h, $m] = array_map('intval', explode(':', $timeStr));
            $t = $h * 60 + $m;
            $pushBlock($t - 60, $t + 60);
        }
    }

    // Build chains of consecutive 30-minute reservations (Validation 01)
    // For each chain length >= 2, block 1 hour starting at the last-overlap point (chain[-2])
    $i = 0;
    $n = count($uniqueTimes);

    while ($i < $n) {
        $chain = [$uniqueTimes[$i]];
        $j = $i + 1;
        while ($j < $n && ($uniqueTimes[$j] - $uniqueTimes[$j - 1] === 30)) {
            $chain[] = $uniqueTimes[$j];
            $j++;
        }

        if (count($chain) >= 2) {
            // Last overlapping time is the second-to-last item in the chain
            $lastOverlap = $chain[count($chain) - 2];
            $pushBlock($lastOverlap, $lastOverlap + 60);
        }

        $i = $j;
    }

    // Merge overlapping blocks
    if (count($proximityBlocks) > 1) {
        usort($proximityBlocks, fn($a, $b) => $a['start'] <=> $b['start']);
        $merged = [$proximityBlocks[0]];
        for ($k = 1; $k < count($proximityBlocks); $k++) {
            $last = &$merged[count($merged) - 1];
            $cur = $proximityBlocks[$k];
            if ($cur['start'] <= $last['end']) {
                $last['end'] = max($last['end'], $cur['end']);
            } else {
                $merged[] = $cur;
            }
        }
        $proximityBlocks = $merged;
    }

    return response()->json([
        'reservations' => $reservations,
        'proximityBlocks' => $proximityBlocks,
    ]);
}

}
