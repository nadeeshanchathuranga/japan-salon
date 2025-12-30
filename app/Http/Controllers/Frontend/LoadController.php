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

        $reservation = Reservation::create([
            'service_id'     => $request->service_id,
            'date'           => $date,
            'time'           => $time,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'other_request'  => $request->other_request,
        ]);

        // Send confirmation email to customer
        Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));

        // Send notification email to admin
        Mail::to(config('app.admin_email'))->send(new ReservationNotification($reservation));

        return back()->with('success', 'ご予約が完了しました！');

    } catch (ValidationException $e) {
        return back()->withErrors($e->errors())->withInput()->with('scroll', 'message');
    } catch (\Exception $e) {
        dd($e);
        return back()->with('error', 'An error occurred: ' . $e->getMessage())->with('scroll', 'message');
    }
}



public function getReservationsByDate(Request $request)
{
    $date = $request->date;

    // Get all reservations for the date ordered by time
    $allReservations = Reservation::where('date', $date)
        ->orderBy('time', 'ASC')
        ->get(['time'])
        ->pluck('time')
        ->toArray();

    // Count by time slot for existing logic
    $reservations = Reservation::where('date', $date)
        ->select('time', DB::raw('count(*) as total'))
        ->groupBy('time')
        ->pluck('total', 'time')
        ->toArray();

    // Find pairs of reservations within 90 minutes and get the latest one
    $latestReservationTimes = [];

    for ($i = 0; $i < count($allReservations) - 1; $i++) {
        $currentTime = strtotime($allReservations[$i]);
        $nextTime = strtotime($allReservations[$i + 1]);

        // Check if next reservation is within 90 minutes
        $diffMinutes = ($nextTime - $currentTime) / 60;

        if ($diffMinutes >= 0 && $diffMinutes <= 90) {
            // Found a pair within 90 minutes, take the latest one
            $latestReservationTimes[] = $allReservations[$i + 1];
        }
    }

    return response()->json([
        'reservations' => $reservations,
        'latestReservationTimes' => array_unique($latestReservationTimes),
    ]);
}

}
