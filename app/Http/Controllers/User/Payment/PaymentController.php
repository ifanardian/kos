<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Payments;
use App\Models\Penyewa;


class PaymentController extends Controller
{
    public function showPayment()
    {
        $user = Auth::user();
        $payment = Payments::where('email', $user->email)
               ->whereNull('tanggal_pembayaran')
               ->orderBy('periode_tagihan', 'desc')
               ->first();
        $detailPenyewa = Penyewa::where('email', $user->email)->first();
        
        return view('user.payment.payment', compact('payment', 'detailPenyewa'));
    }
}
