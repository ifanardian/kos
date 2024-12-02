<?php

use Illuminate\Support\Facades\Route;
//admin
use App\Http\Controllers\Admin\ConfirmBookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SendEmailController;


//user
use App\Http\Controllers\login;
use App\Http\Controllers\User\Dashboard\DashboardController;
use App\Http\Controllers\User\Payment\PaymentController;
use App\Http\Controllers\User\Booking\BookingController;
use App\Http\Controllers\controller_checkout;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/actionlogin', [AuthController::class, 'actionLogin'])->name('actionlogin');

Route::get('/booking', [BookingController::class, 'showCheckout'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('checkout.store');

Route::get('/password/create', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showCreatePasswordForm'])->name('password.create');
Route::post('/password/create', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'storeNewPassword'])->name('password.store');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/tagihan', [PaymentController::class, 'showPayment'])->name('tagihan');
    Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
});

Route::prefix('admin')->group(function () {
    Route::get('/', [ConfirmBookingController::class, 'index'])->name('admin.dashboard');
    Route::get('ktp/{filename}', [ConfirmBookingController::class, 'showKtp'])->name('admin.ktp');
    Route::post('update-status-booking', [ConfirmBookingController::class, 'updateStatusBooking'])->name('admin.update.statusbooking');
    Route::get('send-invoice', [SendEmailController::class, 'sendInvoice'])->name('admin.send.invoice');

    //membuat untuk rill
    Route::get('verifikasi-booking', [ConfirmBookingController::class, 'verifikasiBooking'])->name('admin.verifikasi.booking');
    Route::get('penyewa', [ConfirmBookingController::class, 'penyewa'])->name('admin.penyewa');
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
