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
        $minutes = date('i', strtotime($request->datetime));
        if (!in_array($minutes, ['00', '30'])) {
            throw ValidationException::withMessages([
                'datetime' => ['時間は30分刻みで選択してください（00または30分）'],
            ]);
        }

        // Split datetime to date + time
        $date     = date('Y-m-d', strtotime($request->datetime));
        $time     = date('H:i', strtotime($request->datetime));

        // Check if the selected day is a closed day (Monday=1, Thursday=4)
        $dayOfWeek = date('N', strtotime($date)); // 1=Monday, 7=Sunday
        if (in_array($dayOfWeek, [1, 4])) {
            throw ValidationException::withMessages([
                'datetime' => ['月曜日と木曜日は定休日です。'],
            ]);
        }

        // Check if date/time is not in the past (Japan timezone)
        $selectedDateTime = \Carbon\Carbon::parse($request->datetime, 'Asia/Tokyo');
        $nowJapan = \Carbon\Carbon::now('Asia/Tokyo');
        if ($selectedDateTime->lessThanOrEqualTo($nowJapan)) {
            throw ValidationException::withMessages([
                'datetime' => ['過去の日時は選択できません。'],
            ]);
        }

        // Use database transaction with locking to prevent race conditions
        $reservation = DB::transaction(function () use ($request, $date, $time) {
            // Check if the time slot is not overbooked (max 2 reservations within ±60 minutes)
            $bufferMin = 60;
            $maxCapacity = 2;
            $selectedMinutes = (int)date('H', strtotime($time)) * 60 + (int)date('i', strtotime($time));
            
            // Lock the reservations for this date to prevent race conditions
            $existingReservations = Reservation::where('date', $date)
                ->lockForUpdate()
                ->pluck('time')
                ->map(function ($t) {
                    $parts = explode(':', $t);
                    return (int)$parts[0] * 60 + (int)$parts[1];
                })
                ->toArray();
            
            $conflicts = 0;
            foreach ($existingReservations as $resMin) {
                if (abs($selectedMinutes - $resMin) <= $bufferMin) {
                    $conflicts++;
                }
            }
            
            if ($conflicts >= $maxCapacity) {
                throw ValidationException::withMessages([
                    'datetime' => ['この時間帯は予約がいっぱいです。別の時間をお選びください。'],
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
        \Log::error('Reservation error: ' . $e->getMessage(), ['exception' => $e]);
        return back()->with('error', '予約処理中にエラーが発生しました。もう一度お試しください。')->with('scroll', 'message');
    }
}



public function getReservationsByDate(Request $request)
{
    $date = $request->date;
    
    // Configuration
    $openStart = 10 * 60 + 30;  // 10:30 in minutes
    $openEnd = 18 * 60 + 30;    // 18:30 in minutes
    $stepMin = 30;              // 30-minute intervals
    $bufferMin = 60;            // ±60 minutes buffer
    $maxCapacity = 2;           // Max 2 reservations before blocking

    // Get all reservations for this date
    $reservations = Reservation::where('date', $date)
        ->pluck('time')
        ->map(function ($time) {
            $parts = explode(':', $time);
            return (int)$parts[0] * 60 + (int)$parts[1]; // Convert to minutes
        })
        ->toArray();

    // Generate all time slots and compute conflicts
    $slots = [];
    for ($t = $openStart; $t <= $openEnd; $t += $stepMin) {
        $conflicts = 0;
        
        // Count reservations within ±60 minutes of this slot
        foreach ($reservations as $resMin) {
            if (abs($t - $resMin) <= $bufferMin) {
                $conflicts++;
            }
        }
        
        $timeStr = sprintf('%02d:%02d', floor($t / 60), $t % 60);
        $slots[$timeStr] = [
            'conflicts' => $conflicts,
            'remaining' => max(0, $maxCapacity - $conflicts),
            'disabled' => $conflicts >= $maxCapacity,
        ];
    }

    return response()->json($slots);
}

}
