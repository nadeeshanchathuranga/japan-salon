<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Frontend\LoadController;

use Illuminate\Support\Facades\Route;


Route::get('/', [LoadController::class, 'index'])->name('home');
Route::post('/reservation-store', [LoadController::class, 'reservationStore'])
        ->name('frontend.reservations.store');
Route::get('/reservations-by-date', [LoadController::class, 'getReservationsByDate']);


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::resource('testimonials', TestimonialController::class);
     Route::resource('services', ServiceController::class);
     Route::resource('reservations', ReservationController::class);
});






require __DIR__.'/auth.php';
