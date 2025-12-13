<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Service;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Mail\ReservationConfirmation;
use App\Mail\ReservationNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

class LoadController extends Controller
{
    



   public function index()
    {

$services = Service::where('is_active', true)
                   ->orderBy('id', 'desc') // or another column you prefer
                   ->get();
 


$testimonials = Testimonial::where('is_active', true)
                   ->orderBy('id', 'desc') // or another column you prefer
                   ->get();


        return view('frontend.index',compact('services','testimonials'));
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

        return back()->with('success', 'Booking added successfully!');

    } catch (ValidationException $e) {
        return back()->withErrors($e->errors())->withInput()->with('scroll', 'message');
    } catch (\Exception $e) {
        dd($e);
        return back()->with('error', 'An error occurred: ' . $e->getMessage())->with('scroll', 'message');
    }
}

}
