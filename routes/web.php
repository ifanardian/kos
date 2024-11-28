<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\controller_dashboard;
use App\Http\Controllers\controller_register;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\controller_checkout;
use App\Http\Controllers\Admin\ConfirmBookingController;



// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/actionlogin', [AuthController::class, 'actionLogin'])->name('actionlogin');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/action', [AuthController::class, 'actionRegister'])->name('actionregister');

Route::get('/', [controller_dashboard::class, 'index'])->name('dashboard');

Route::get('/booking', [BookingController::class, 'showCheckout'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('checkout.store');

// Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // Route::get('/admin/dashboard', [controller_dashboard::class, 'adminIndex'])->name('admin.dashboard');
    // Route::get('/admin/users', [controller_register::class, 'listUsers'])->name('admin.users');
    // Route::post('/admin/users/create', [controller_register::class, 'createUser'])->name('admin.users.create');
    // Route::delete('/admin/users/{id}', [controller_register::class, 'deleteUser'])->name('admin.users.delete');
// });

Route::get('/admin', [ConfirmBookingController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/ktp/{filename}', [ConfirmBookingController::class, 'showKtp'])->name('ktp.show');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
    
    Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
});