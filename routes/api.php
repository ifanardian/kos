<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/action-login', [App\Http\Controllers\login::class, 'login']);

Route::post('/action-register', [App\Http\Controllers\login::class, 'actionRegister']);
