<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Katalog kamar (semua user login bisa lihat)
    Route::get('/kamar', [RoomController::class, 'catalog'])->name('rooms.catalog');

    // Booking
    Route::get('/booking', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/booking/{room}/ajukan', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');

    // Pembayaran
    Route::get('/pembayaran', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/pembayaran/{booking}/upload', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/pembayaran/{booking}', [PaymentController::class, 'store'])->name('payments.store');

    // Komplain
    Route::get('/komplain', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/komplain/buat', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/komplain', [ComplaintController::class, 'store'])->name('complaints.store');

    // Khusus ADMIN
    Route::middleware('admin')->group(function () {
        Route::resource('rooms', RoomController::class)->except(['show']);
        Route::patch('/booking/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
        Route::patch('/booking/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
        Route::patch('/pembayaran/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
        Route::patch('/komplain/{complaint}/status', [ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
    });
});

require __DIR__.'/auth.php';