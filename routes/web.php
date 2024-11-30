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

Route::get('/booking', [BookingController::class, 'showCheckout'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('checkout.store');


Route::prefix('admin')->group(function () {
    Route::get('/', [ConfirmBookingController::class, 'index'])->name('admin.dashboard');
    Route::get('ktp/{filename}', [ConfirmBookingController::class, 'showKtp'])->name('admin.ktp');
    Route::post('update-status-booking', [ConfirmBookingController::class, 'updateStatusBooking'])->name('admin.update.statusbooking');
    Route::get('send-invoice', [SendEmailController::class, 'sendInvoice'])->name('admin.send.invoice');


    //membuat untuk rill
    Route::get('verifikasi-booking', [ConfirmBookingController::class, 'verifikasiBooking'])->name('admin.verifikasi.booking');
    Route::get('penyewa', [ConfirmBookingController::class, 'penyewa'])->name('admin.penyewa');
});



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
    
    Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
});


// FIONA

// admin
Route::get('/cdashboardadmin', [AdminController::class, 'dashboardAdmin'])->name('dashboardadmin');
Route::get('/cpenyewaadmin', [AdminController::class, 'penyewaAdmin'])->name('penyewaadmin');
Route::get('/ckamaradmin', [AdminController::class, 'kamarAdmin'])->name('kamaradmin');
Route::get('/criwayatadmin', [AdminController::class, 'riwayatAdmin'])->name('riwayatadmin');
Route::get('/cverifikasiadmin', [AdminController::class, 'verifikasiAdmin'])->name('verifikasiadmin');
Route::get('/cwebsiteadmin', [AdminController::class, 'websiteAdmin'])->name('websiteadmin');

// user
Route::get('/cbooking', [AdminController::class, 'booking'])->name('cobabooking');
Route::get('/cpayment', [AdminController::class, 'payment'])->name('cobapayment');
Route::get('/ctagihan', [AdminController::class, 'tagihan'])->name('cobatagihan');
