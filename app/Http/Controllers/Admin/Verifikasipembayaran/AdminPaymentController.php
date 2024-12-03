<?php

namespace App\Http\Controllers\Admin\Verifikasipembayaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminPaymentController extends Controller
{
    public function showPayment()
    {
        // dd('masuk');
        $data =  DB::table('payments')
            ->orderby('status_verifikasi', 'desc')
            ->orderBy('periode_tagihan', 'desc')
            ->get();
        // dd($payment);
        return view('admin.verifikasi-pembayaran.admin-riwayat', compact('data'));
    }

    public function actionPayment(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'periode_tagihan' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);
        if ($request->metode_pembayaran == 'Transfer') {
            DB::table('payments')
            ->where('email', $request->email)
            ->where('periode_tagihan', $request->periode_tagihan)
            ->update([
                'status_verifikasi' => true,
                'updated_at' => now(),
            ]);  
        }else{
            DB::table('payments')
            ->where('email', $request->email)
            ->where('periode_tagihan', $request->periode_tagihan)
            ->update([
                'tanggal_pembayaran' => date('Y-m-d'),
                'status_verifikasi' => true,
                'updated_at' => now(),
            ]);
        }
              
        return redirect()->route('dashboard');
    }
}
