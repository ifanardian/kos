<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\controller_dashboard;
use App\Http\Controllers\controller_register;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\controller_checkout;
use App\Http\Controllers\Admin\ConfirmBookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SendEmailController;


// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/actionlogin', [AuthController::class, 'actionLogin'])->name('actionlogin');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/action', [AuthController::class, 'actionRegister'])->name('actionregister');

Route::get('/', [controller_dashboard::class, 'index'])->name('dashboard');
Route::get('/admin', [AdminController::class, 'dashboardAdmin'])->name('dashboardAdmin');

Route::get('/booking', [BookingController::class, 'showCheckout'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('checkout.store');

Route::get('/admin2', [ConfirmBookingController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/ktp/{filename}', [ConfirmBookingController::class, 'showKtp'])->name('ktp.show');
Route::post('/admin/update-status-booking', [ConfirmBookingController::class, 'updateStatusBooking'])->name('update.status.booking');
Route::get('/admin/send-invoice', [SendEmailController::class, 'sendInvoice'])->name('send.invoice');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
    
    Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
});