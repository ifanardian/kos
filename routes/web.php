<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\controller_dashboard;
use App\Http\Controllers\controller_register;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\controller_checkout;
// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/actionlogin', [AuthController::class, 'actionLogin'])->name('actionlogin');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/action', [AuthController::class, 'actionRegister'])->name('actionregister');

Route::get('/', [controller_dashboard::class, 'index'])->name('dashboard');

Route::get('/booking', [BookingController::class, 'showCheckout'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('checkout.store');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
    
    Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
});