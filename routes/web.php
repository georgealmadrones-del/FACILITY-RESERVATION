<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // User Routes
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::post('/reservations/{id}/return', [ReservationController::class, 'returnUnit'])->name('reservations.return');

    Route::get('/availability', function () {
        return view('dashboard');
    })->name('availability');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Database-Driven Routes
    Route::get('/admin/dashboard', [ReservationController::class, 'adminIndex'])->name('admin.dashboard');
    Route::post('/admin/reservations/{id}/approve', [ReservationController::class, 'approve'])->name('admin.reservations.approve');
    Route::post('/admin/reservations/{id}/reject', [ReservationController::class, 'reject'])->name('admin.reservations.reject');

    // Facility Management
    Route::post('/admin/facilities', [ReservationController::class, 'storeFacility'])->name('admin.facilities.store');
    Route::put('/admin/facilities/{id}', [ReservationController::class, 'updateFacility'])->name('admin.facilities.update');
    Route::delete('/admin/facilities/{id}', [ReservationController::class, 'deleteFacility'])->name('admin.facilities.delete');

    // Equipment Management
    Route::post('/admin/equipment', [ReservationController::class, 'storeEquipment'])->name('admin.equipment.store');
    Route::put('/admin/equipment/{id}', [ReservationController::class, 'updateEquipment'])->name('admin.equipment.update');
    Route::delete('/admin/equipment/{id}', [ReservationController::class, 'deleteEquipment'])->name('admin.equipment.delete');

    // User Management
    Route::post('/admin/users/{id}/toggle', [ReservationController::class, 'toggleUserStatus'])->name('admin.users.toggle');
});

require __DIR__.'/auth.php';