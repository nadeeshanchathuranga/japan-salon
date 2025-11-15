<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
     public function store(Request $request)
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

        // Split datetime to date + time
        $date     = date('Y-m-d', strtotime($request->datetime));
        $time     = date('H:i', strtotime($request->datetime));

        Reservation::create([
            'service_id'     => $request->service_id,
            'date'           => $date,
            'time'           => $time,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'other_request'  => $request->other_request,
        ]);

        return back()->with('success', 'Booking added successfully!');

    } catch (ValidationException $e) {
        return back()->withErrors($e->errors())->withInput()->with('scroll', 'message');
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred: ' . $e->getMessage())->with('scroll', 'message');
    }
}






  public function index()
    {
        $services = Service::where('is_active', true)
                   ->orderBy('id', 'desc') // or another column you prefer
                   ->get();
 
       $reservations = Reservation::orderBy('created_at', 'desc')->paginate(12);
        return view('reservations.index', compact('reservations','services'));
    }




 public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }




public function update(Request $request, Reservation $reservation)
{
    try {
        // Validate request
        $request->validate([
            'service_id'       => 'required|exists:services,id',
            'datetime'         => 'required|date_format:Y-m-d\TH:i',
            'name'             => 'required|string|max:100',
            'phone'            => 'required|digits_between:7,11',
            'email'            => 'required|email|max:255',
            'other_request'    => 'nullable|string|max:1000',
        ]);

        // Split datetime into date + time
        $date = date('Y-m-d', strtotime($request->datetime));
        $time = date('H:i', strtotime($request->datetime));

        // Update reservation
        $reservation->update([
            'service_id'     => $request->service_id,
            'date'           => $date,
            'time'           => $time,
            'name'           => $request->name,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'other_request'  => $request->other_request,
        ]);

        return back()->with('success', 'Reservation updated successfully!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withErrors($e->errors())->withInput()->with('scroll', 'message');
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred: ' . $e->getMessage())->with('scroll', 'message');
    }
}







    
}
