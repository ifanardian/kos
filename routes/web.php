<?php

use Illuminate\Support\Facades\Route;
//admin
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ConfirmBookingController;
use App\Http\Controllers\Admin\SendEmailController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\KelolaWebsiteController;
use App\Http\Controllers\AdminController;


//user
use App\Http\Controllers\login;
use App\Http\Controllers\User\Dashboard\DashboardController;
use App\Http\Controllers\User\Payment\PaymentController;
use App\Http\Controllers\User\Booking\BookingController;
// use App\Http\Controllers\controller_checkout;
use App\Http\Controllers\Auth\AuthController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/actionlogin', [AuthController::class, 'actionLogin'])->name('actionlogin');

Route::get('/booking', [BookingController::class, 'showCheckout'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('checkout.store');

Route::get('/password/create', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showCreatePasswordForm'])->name('password.create');
Route::post('/password/create', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'storeNewPassword'])->name('password.store');
// fiona coba lupa password
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/payment', [PaymentController::class, 'showPayment'])->name('tagihan');
    Route::post('/payment', [PaymentController::class, 'payment'])->name('payment.action');
    Route::post('/payment-history', [PaymentController::class, 'historyPembayaran'])->name('payment.history');
    // Route::get('/checkout', [controller_checkout::class, 'checkout'])->name('checkout'); 
});


Route::prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'showIndex'])->name('admin.dashboard');
    Route::get('ktp/{filename}', [ConfirmBookingController::class, 'showKtp'])->name('admin.ktp');
    Route::post('update-status-booking', [ConfirmBookingController::class, 'updateStatusBooking'])->name('admin.update.statusbooking');
    Route::get('send-invoice', [SendEmailController::class, 'sendInvoice'])->name('admin.send.invoice');
    // fiona tambah
    Route::get('/kelola-kamar', [KamarController::class, 'ShowIndex'])->name('admin.kelola_kamar');
    Route::post('/kelola-kamar/tipekos', [KamarController::class, 'PostTipeLangganan'])->name('post.admin.tipekos');
    Route::post('/kelola-kamar/update', [AdminController::class, 'updateTipeKos'])->name('admin.harga_kamar.update');
    Route::get('/get-kamar-tersedia', [ConfirmBookingController::class, 'getKamarTersedia']) ->name('admin.get_kamar_tersedia');
    Route::post('/kelola-kamar/kamar', [KamarController::class, 'PostKamar'])->name('post.admin.kamar');

    //membuat untuk rill
    Route::get('verifikasi-booking', [ConfirmBookingController::class, 'verifikasiBooking'])->name('admin.verifikasi.booking');
    Route::get('penyewa', [ConfirmBookingController::class, 'penyewa'])->name('admin.penyewa');
    Route::get('penyewa/aktif/{id}', [ConfirmBookingController::class, 'detailPenyewa'])->name('admin.penyewa.aktif');

    Route::get('kelola-website', [KelolaWebsiteController::class, 'ShowKelolaWebsite'])->name('admin.kelolawebsite');
    Route::post('kelola-website', [KelolaWebsiteController::class, 'PostPanorama'])->name('post.admin.kelolawebsite');
    Route::post('kelola-website/detail', [KelolaWebsiteController::class, 'DetailKelolaWebsite'])->name('admin.detail.kelolawebsite');
    Route::post('kelola-website/hotspots/save', [KelolaWebsiteController::class, 'SaveHotspots'])->name('admin.save.Hotspots');
    Route::post('kelola-website/hotspots/delete', [KelolaWebsiteController::class, 'DeletePanorama'])->name('admin.delete.panorama');
    
    // fiona
    Route::post('/penyewa-update', [ConfirmBookingController::class, 'updatePenyewa'])->name('admin.penyewa.update');
    Route::get('payment', [AdminPaymentController::class, 'showPayment'])->name('admin.payment');
    Route::post('payment', [AdminPaymentController::class, 'actionPayment'])->name('admin.action.pembayaran');
    Route::get('payment/history/{id}', [AdminPaymentController::class, 'getHistoryPembayaran'])->name('admin.pembayaran.history');
    Route::get('tf/{filename}', [AdminPaymentController::class, 'showbuktitf'])->name('admin.buktitf');
    Route::post('payment/tagih', [AdminPaymentController::class, 'makeTagihPembayaran'])->name('admin.pemabayaran.tagih');

});



// FIONA

// admin
Route::get('/cdashboardadmin', [AdminController::class, 'dashboardAdmin'])->name('dashboardadmin'); // sudah tak pindah ke admin/
Route::get('/cpenyewaadmin', [AdminController::class, 'penyewaAdmin'])->name('penyewaadmin');
Route::get('/ckamaradmin', [AdminController::class, 'kamarAdmin'])->name('kamaradmin');
Route::get('/criwayatadmin', [AdminController::class, 'riwayatAdmin'])->name('riwayatadmin');
Route::get('/cverifikasiadmin', [AdminController::class, 'verifikasiAdmin'])->name('verifikasiadmin');
Route::get('/cwebsiteadmin', [AdminController::class, 'websiteAdmin'])->name('websiteadmin');

// user
Route::get('/cbooking', [AdminController::class, 'booking'])->name('cobabooking');
Route::get('/cpayment', [AdminController::class, 'payment'])->name('cobapayment');
Route::get('/ctagihan', [AdminController::class, 'tagihan'])->name('cobatagihan');

Route::get('/cpassword', [AdminController::class, 'password'])->name('cobapassword');
