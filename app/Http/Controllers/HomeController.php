<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index()
    {

$services = Service::where('is_active', true)
                   ->orderBy('id', 'desc') // or another column you prefer
                   ->get();


$testimonials = Testimonial::where('is_active', true)
                   ->orderBy('id', 'desc') // or another column you prefer
                   ->get();


        return view('welcome',compact('services','testimonials'));
    }
}
