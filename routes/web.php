<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\controller_dashboard;
use App\Http\Controllers\controller_register;
use App\Http\Controllers\controller_booking;
use App\Http\Controllers\controller_checkout;
// use Illuminate\Support\Facades\Auth;

Route::get('/', [login::class, 'login'])->name('login');

Route::post('/actionlogin', [login::class, 'actionlogin'])->name('actionlogin');
Route::post('/logout', [login::class, 'actionlogout'])->name('logout');

Route::get('/register', [controller_register::class, 'register'])->name('register');
Route::post('/register/action', [controller_register::class, 'actionRegister'])->name('actionregister');

Route::get('/dashboard', [controller_dashboard::class, 'index'])->name('dashboard'); #->middleware('auth');

// Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
Route::get('/booking', [controller_booking::class, 'showCheckout'])->name('booking');
Route::post('/booking', [controller_booking::class, 'store'])->name('checkout.store');

Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 