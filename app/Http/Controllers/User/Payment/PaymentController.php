<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Penyewa;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function showPayment()
    {
        $user = Auth::user();
        $payment = DB::table('payments')
            ->where('id_penyewa', $user->id_penyewa)
            ->orderBy('periode_tagihan', 'desc')
            ->first();
        $paymentCount = DB::select('
            SELECT 
                SUM(CASE WHEN status_verifikasi IS NULL THEN 1 ELSE 0 END) AS tagihan_belum_terverifikasi,
                COUNT(*) AS total_tagihan
            FROM payments
            WHERE id_penyewa = ?
            ', [$user->id_penyewa]);
    
        $detailPenyewa = Penyewa::where('id', $user->id_penyewa)->first();
        $isFirstPayment = false;
        if ($paymentCount[0]->tagihan_belum_terverifikasi == 0 && $paymentCount[0]->total_tagihan > 0) {
            $isFirstPayment = false; // Pembayaran bulanan
        } else {
            $isFirstPayment = true; // Pembayaran pertama kali
        }
    
        return view('user.payment.payment', compact('payment', 'detailPenyewa', 'isFirstPayment'));
    }

    public function payment(Request $request)
    {
        $request->validate([
            'id_penyewa' => 'required|integer',
            'metode_pembayaran' => 'required|string',
            'bukti_tf' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);
        $isFirstPayment = DB::table('payments')
            ->where('id_penyewa', $request->id_penyewa)
            ->whereNull('metode_pembayaran')
            ->count();
        $penyewa = DB::table('penyewa')
            ->where('id', $request->id_penyewa)
            ->first();
        $fileName = null;
        if ($request->file('bukti_tf')) {
            $bukti_pembayaran = $request->file('bukti_tf');
            $fileName =$request->email.'-'.date('d-m-Y').'.'.$bukti_pembayaran->extension();
            $filePath = $bukti_pembayaran->storeAs('bukti pembayaran/'.$request->email, $fileName, 'local');
        }

        if ($isFirstPayment == 0) {
            $tagihan = DB::table('ms_tipe_kos')
                        ->where('id', $penyewa->tipe_kos)
                        ->first();
            
            DB::table('payments')
                ->insert([
                    'id_penyewa' => $request->id_penyewa,
                    'periode_tagihan' => Carbon::parse($penyewa->tanggal_jatuh_tempo)->format('Y-m-d'),
                    'id_kamar' => $penyewa->no_kamar,
                    'total_tagihan' => $tagihan->harga,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'bukti_pembayaran' => $request->metode_pembayaran == 'Transfer' ? $fileName : null,
                    'tanggal_pembayaran' => $request->metode_pembayaran == 'Transfer' ? date('Y-m-d') : null,
                    'status_verifikasi' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }else{
            DB::table('payments')
                ->where('id_penyewa', $request->id_penyewa)
                ->whereNull('metode_pembayaran')   
                ->update([
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'bukti_pembayaran' => $request->metode_pembayaran == 'Transfer' ? $fileName : null,
                    'tanggal_pembayaran' => $request->metode_pembayaran == 'Transfer' ? date('Y-m-d') : null,
                    'status_verifikasi' => null,
                    'updated_at' => now(),
                ]); 
        }       
        return redirect()->route('dashboard')->with('success', 'Pembayaran Anda berhasil dilakukan. Harap menunggu verifikasi.');
    }

    public function historyPembayaran()
    {
        $user = Auth::user()->id_penyewa;
        // $userEmail = auth()->user()->email; // Ambil email pengguna yang login
        $paymentHistory = DB::table('payments')
            ->where('id_penyewa', $user)
            ->orderBy('periode_tagihan', 'desc')
            ->get();

        return view('history_pembayaran', compact('paymentHistory'));
    }

}
