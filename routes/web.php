<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Temporary migration trigger (remove or protect once migrations are complete)
Route::get('/run-migrations-now', function () {
    $exitCode = Artisan::call('migrate', ['--force' => true]);

    return 'Migration executed with exit code: ' . $exitCode . '<br>Output: <pre>' . Artisan::output() . '</pre>';
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::post('/reservations/{id}/return', [ReservationController::class, 'returnUnit'])->name('reservations.return');

    // Bot assistant
    Route::post('/bot/reply', [BotController::class, 'reply'])->name('bot.reply');

    // Help & Support Chat + Admin Threads
    Route::get('/chat/messages', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/messages', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/threads', [ChatController::class, 'threads'])->name('chat.threads');

    // Profile & persistent profile photos
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo-info', [ProfilePhotoController::class, 'updateUser'])->name('profile.photo.update');

    // Admin Routes (Using match for POST and PATCH to eliminate 405 errors)
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/profile/update', [ProfilePhotoController::class, 'updateAdmin'])->name('admin.profile.update');
    Route::match(['post', 'patch'], '/admin/reservations/{reservation}/approve', [AdminController::class, 'approve'])->name('admin.reservations.approve');
    Route::match(['post', 'patch'], '/admin/reservations/{reservation}/reject', [AdminController::class, 'reject'])->name('admin.reservations.reject');

    // Facility Management
    Route::post('/admin/facilities', [AdminController::class, 'storeFacility'])->name('admin.facilities.store');
    Route::put('/admin/facilities/{facility}', [AdminController::class, 'updateFacility'])->name('admin.facilities.update');
    Route::delete('/admin/facilities/{facility}', [AdminController::class, 'destroyFacility'])->name('admin.facilities.destroy');

    // Equipment Management
    Route::post('/admin/equipment', [AdminController::class, 'storeEquipment'])->name('admin.equipment.store');
    Route::put('/admin/equipment/{equipment}', [AdminController::class, 'updateEquipment'])->name('admin.equipment.update');
    Route::delete('/admin/equipment/{equipment}', [AdminController::class, 'destroyEquipment'])->name('admin.equipment.destroy');

    // User Management
    Route::post('/admin/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('admin.users.toggle');

    // Reports & PDF Export
    Route::get('/admin/reports/pdf', [AdminController::class, 'exportPdf'])->name('admin.reports.pdf');
});

require __DIR__ . '/auth.php';