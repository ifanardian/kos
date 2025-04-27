<?php

// Tentukan path ke direktori aplikasi Laravel
$laravel = _DIR_ . '/../';

// Muat file autoload Composer
require $laravel . 'vendor/autoload.php';

// Tentukan environment
$env = 'production';

// Tentukan path ke file bootstrap Laravel
$bootstrap = $laravel . 'bootstrap/app.php';

// Buat instance aplikasi Laravel
$app = require_once $bootstrap;

// Jalankan aplikasi dan tangani respons
$response = $app->handle(
    $request = Illuminate\Http\Request::capture()
);

// Kirim respons kembali ke browser
$response->send();

// Akhiri siklus aplikasi
$app->terminate($request, $response);