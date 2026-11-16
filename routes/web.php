<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Authenticated User & Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Main Dashboard & Real-Time Reservations
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');
    
    // Store New Reservation Request
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    
    // Cancel a Reservation
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    
    // Return Borrowed Unit/Equipment
    Route::post('/reservations/{id}/return', [ReservationController::class, 'returnUnit'])->name('reservations.return');

    // Availability Calendar Page View
    Route::get('/availability', function () {
        return view('dashboard');
    })->name('availability');

    // Profile Edit Page (Breeze default)
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Dashboard Route & Management Actions
    Route::get('/admin/dashboard', function () {
        $reservations = Reservation::latest()->get();
        return view('admin.dashboard', compact('reservations'));
    })->name('admin.dashboard');

    Route::post('/admin/reservations/{id}/approve', function ($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'approved']);
        return back();
    })->name('admin.reservations.approve');

    Route::post('/admin/reservations/{id}/reject', function ($id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'cancelled']);
        return back();
    })->name('admin.reservations.reject');
});

require __DIR__.'/auth.php';