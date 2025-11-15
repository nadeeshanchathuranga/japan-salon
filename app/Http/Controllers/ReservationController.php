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

}
