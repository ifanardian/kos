<?php
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{IndexController, AdminBookingController, AdminPaymentController, KelolaKamarController, KelolaWebsiteController, PenyewaController};
use App\Http\Controllers\User\{BookingController, DashboardController, PaymentController};
use App\Http\Controllers\Auth\{AuthController, ForgotPasswordController};
use App\Http\Controllers\CekPembayaranBooking;


Route::get('/cek-pembayaran-booking', [CekPembayaranBooking::class, 'cekPembayaranSekali'])->name('cek.pembayaran.sekaligus');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::get('/password/create', [ForgotPasswordController::class, 'showCreatePasswordForm'])->name('password.create');
Route::post('/password/create', [ForgotPasswordController::class, 'storeNewPassword'])->name('password.store');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('booking', [BookingController::class, 'showCheckout'])->name('booking');
Route::post('booking', [BookingController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/payment', [PaymentController::class, 'showPayment'])->name('tagihan');
    Route::post('/payment', [PaymentController::class, 'payment']);
    Route::post('/payment-history', [PaymentController::class, 'historyPembayaran'])->name('payment.history');
});


Route::middleware(['auth','admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [IndexController::class, 'showIndex'])->name('admin.dashboard');

        Route::get('kelola-website', [KelolaWebsiteController::class, 'ShowKelolaWebsite'])->name('admin.kelolawebsite');
        Route::post('kelola-website', [KelolaWebsiteController::class, 'PostPanorama']);
        Route::post('kelola-website/detail', [KelolaWebsiteController::class, 'DetailKelolaWebsite'])->name('admin.kelolawebsite.detail');
        Route::post('kelola-website/hotspots/save', [KelolaWebsiteController::class, 'SaveHotspots'])->name('admin.kelolawebsite.hotspots');
        Route::post('kelola-website/hotspots/delete', [KelolaWebsiteController::class, 'DeletePanorama'])->name('admin.kelolawebsite.hotspots.delete');
        Route::post('kelola-website/grid',[KelolaWebsiteController::class, 'GridGambar'])->name('admin.kelolawebsite.grid');

        Route::get('penyewa', [PenyewaController::class, 'penyewa'])->name('admin.penyewa');
        Route::post('penyewa', [PenyewaController::class, 'updatePenyewa']);
        Route::get('penyewa/{id}', [PenyewaController::class, 'detailPenyewa'])->name('admin.penyewa.byid');
        Route::post('/admin/penyewa/tambah', [PenyewaController::class, 'tambahPenyewa'])->name('admin.penyewa.tambah');
        
        Route::get('/kelola-kamar', [KelolaKamarController::class, 'ShowIndex'])->name('admin.kelolakamar');
        Route::post('/kelola-kamar/tipekos', [KelolaKamarController::class, 'PostTipeLangganan'])->name('admin.kelolakamar.tipekos');
        Route::post('/kelola-kamar/tipekos/update', [KelolaKamarController::class, 'updateTipeKos'])->name('admin.kelolakamar.tipekos.update');
        Route::post('/kelola-kamar', [KelolaKamarController::class, 'PostKamar']);

        Route::get('payment', [AdminPaymentController::class, 'showPayment'])->name('admin.payment');
        Route::post('payment', [AdminPaymentController::class, 'actionPayment']);
        Route::get('payment/history/{id}', [AdminPaymentController::class, 'getHistoryPembayaran'])->name('admin.payment.byid');
        Route::get('payment/tf/{filename}', [AdminPaymentController::class, 'showbuktitf'])->name('admin.payment.gambar');
        Route::post('payment/tagih', [AdminPaymentController::class, 'makeTagihPembayaran'])->name('admin.payment.emailtagih');

        Route::get('booking', [AdminBookingController::class, 'verifikasiBooking'])->name('admin.booking');
        Route::post('booking', [AdminBookingController::class, 'updateStatusBooking']);
        Route::get('ktp/{filename}', [AdminBookingController::class, 'showKtp'])->name('admin.ktp.gambar');
    });
});
