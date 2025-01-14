<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Penyewa;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function showPayment()
    {
        // lama
        // $user = Auth::user();
        // $payment =  DB::table('payments')
        //     ->where('email', $user->email)
        //     ->whereNull('metode_pembayaran')
        //     ->orderBy('periode_tagihan', 'desc')
        //     ->first();
        // if (!$payment) {
        //     return redirect()->route('dashboard');//tidak ada tagihan
        // }
        // $detailPenyewa = Penyewa::where('email', $user->email)->first();
        // return view('user.payment.payment', compact('payment', 'detailPenyewa'));

        // fiona coba bulanan
        $user = Auth::user();
        $payment = DB::table('payments')
            ->where('email', $user->email)
            ->whereNull('metode_pembayaran') // Tagihan yang belum dibayar
            ->orderBy('periode_tagihan', 'desc')
            ->first();
    
        $detailPenyewa = Penyewa::where('email', $user->email)->first();
    
        if (!$payment) {
            // Jika tidak ada tagihan baru, ambil informasi pembayaran terakhir
            $payment = DB::table('payments')
                ->where('email', $user->email)
                ->orderBy('periode_tagihan', 'desc')
                ->first();
    
            if ($payment) {
                $isFirstPayment = false; // Pembayaran bulanan
            } else {
                return redirect()->route('dashboard'); // Tidak ada data sama sekali
            }
        } else {
            $isFirstPayment = true; // Pembayaran pertama kali
        }
    
        return view('user.payment.payment', compact('payment', 'detailPenyewa', 'isFirstPayment'));
    }

    public function payment(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'periode_tagihan' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'bukti_tf' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);
        $fileName = null;
        if ($request->file('bukti_tf')) {
            $bukti_pembayaran = $request->file('bukti_tf');
            $fileName =$request->email.'-'.date('d-m-Y').'.'.$bukti_pembayaran->extension();
            $filePath = $bukti_pembayaran->storeAs('bukti pembayaran/'.$request->email, $fileName, 'local');
        }

        DB::table('payments')
            ->where('email', $request->email)
            ->where('periode_tagihan', $request->periode_tagihan)
            ->update([
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_pembayaran' => $request->metode_pembayaran == 'Transfer' ? $fileName : null,
                'tanggal_pembayaran' => $request->metode_pembayaran == 'Transfer' ? date('Y-m-d') : null,
                'status_verifikasi' => false,
                'updated_at' => now(),
            ]);        
        return redirect()->route('dashboard');
    }
}
