<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Penyewa;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

use App\Models\Payment;

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
                SUM(CASE WHEN metode_pembayaran IS NULL THEN 1 ELSE 0 END) AS belum_bayar_verifikasi,
                SUM(CASE WHEN status_verifikasi = 0 THEN 1 ELSE 0 END) AS tagihan_tidak_terverifikasi,
                SUM(CASE WHEN status_verifikasi = 1 THEN 1 ELSE 0 END) AS tagihan_sudah_terverifikasi,

                COUNT(*) AS total_tagihan
            FROM payments
            WHERE id_penyewa = ?
            ', [$user->id_penyewa]);
        
            $detailPenyewa = Penyewa::where('id_penyewa', $user->id_penyewa)->first();
            $isFirstPayment = false;
            if ($paymentCount[0]->belum_bayar_verifikasi > 0 || $paymentCount[0]->tagihan_tidak_terverifikasi == $paymentCount[0]->total_tagihan) {
                $isFirstPayment = true;
            }

            // dd([
            //     'user_id' => $user->id,
            //     'user_id_penyewa' => $user->id_penyewa,
            //     'detailPenyewa' => $detailPenyewa,
            // ]);
            
    
        return view('user.payment.payment', compact('payment', 'detailPenyewa', 'isFirstPayment'));
    }

    public function payment(Request $request)
    {
        $request->validate([
            'id_penyewa' => 'required|integer',
            'metode_pembayaran' => 'required|string',
            'bukti_tf' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $payment = Payment::wherenull('metode_pembayaran')->wherenull('status_verifikasi')->where('id_penyewa',$request->id_penyewa)->get();
        // dd($payment);
        // $paymentCount = DB::select('
        // SELECT 
        //     SUM(CASE WHEN metode_pembayaran IS NULL THEN 1 ELSE 0 END) AS belum_bayar_verifikasi,
        //     SUM(CASE WHEN status_verifikasi = 0 THEN 1 ELSE 0 END) AS tagihan_tidak_terverifikasi,
        //     SUM(CASE WHEN status_verifikasi = 1 THEN 1 ELSE 0 END) AS tagihan_sudah_terverifikasi,

        //     COUNT(*) AS total_tagihan
        // FROM payments
        // WHERE id_penyewa = ?
        // ', [$request->id_penyewa]);
        $isFirstPayment = false;
        if(!$payment->isEmpty()){
            $isFirstPayment = true;
        }
        // if ($paymentCount[0]->belum_bayar_verifikasi > 0 || $paymentCount[0]->tagihan_tidak_terverifikasi == $paymentCount[0]->total_tagihan) {
        //     $isFirstPayment = true;
        // }
        // dd($isFirstPayment);
        $penyewa = DB::table('penyewa')
            ->where('id_penyewa', $request->id_penyewa)
            ->first();

        $fileName = null;
        $fileUrl = null;
        
        // local simpan di folder local
        // if ($request->file('bukti_tf')) {
        //     $bukti_pembayaran = $request->file('bukti_tf');
        //     $fileName = $penyewa->email.'-'.date('d-m-Y').'.'.$bukti_pembayaran->extension();
        //     $filePath = $bukti_pembayaran->storeAs('bukti pembayaran/'.$penyewa->email, $fileName, 'local');
        // }        

        if ($request->file('bukti_tf')) {
            $buktiPembayaran = $request->file('bukti_tf');
            
            // Initialize Cloudinary configuration
            $cloudinary = new Cloudinary();
    
            // Upload the image to Cloudinary
            $uploadedFile = $cloudinary->uploadApi()->upload($buktiPembayaran->getRealPath(), [
                'folder' => 'kos/bukti_tf',
                'public_id' => $penyewa->email . '-' . time(),
                'overwrite' => true,
            ]);
    
            // Get the file's secure URL after upload
            $fileName = $uploadedFile['public_id']; // ini simpan nama file nya

        }

        if (!$isFirstPayment) {
            $tagihan = DB::table('ms_tipe_kos')
                        ->where('id_tipe_kos', $penyewa->tipe_kos)
                        ->first();

            $bulan = $tagihan->bulan;
            
            DB::table('payments')
                ->insert([
                    'id_penyewa' => $request->id_penyewa,
                    'periode_tagihan' => Carbon::parse($penyewa->tanggal_jatuh_tempo)->format('Y-m-d'),
                    'id_kamar' => $penyewa->no_kamar,
                    'total_tagihan' => $tagihan->harga,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'bukti_pembayaran' => $request->metode_pembayaran == 'Transfer' ? $fileName : null,
                    'tanggal_pembayaran' => Carbon::now()->format('Y-m-d'),
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
                    'tanggal_pembayaran' => Carbon::now()->format('Y-m-d'),
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
