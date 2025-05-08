<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\MsTipeKos;
use App\Models\Penyewa;
use App\Models\Users;
use App\Models\Payment;
use App\Models\Kamar;

class CekPembayaranBooking extends Controller
{
    public function cekPembayaranSekali()
    {   $result= NULL;
        $created = NULL;
        $payment = Payment::where('status_verifikasi', NULL)->where('metode_pembayaran',NULL)->get();
        $result = 'tidak ada pembayaran yang belum terverifikasi';
        if (!$payment->isEmpty()) {
            $result = 'pembayaran belum lebih dari 24 jam';
            foreach ($payment as $p){
                $selisih = (now()->diffInMinutes($p->created_at));
                if($selisih > 1440 ){
                    DB::transaction(function () use ($p) {
                        $penyewa = Penyewa::where('id_penyewa', $p->id_penyewa)->first();
                        
                        // Hapus data terkait penyewa
                        Users::where('email', $penyewa->email)->delete();
                        Payment::where('id_penyewa', $p->id_penyewa)->delete();
                        
                        // Update status booking
                        Booking::where('id_booking', $penyewa->id_booking)->update(['status' => 'CANCELED']);
                        
                        // Update status kamar
                        Kamar::where('id_kamar', $penyewa->no_kamar)->update(['status' => 'F']);
                        
                        // Hapus data penyewa
                        $penyewa->delete();
                    });

                    return response()->json(['result' =>'pembayaran sudah lebih dari 24 jam','selisih'=>$selisih,'vercel'=>now(),'created_at'=>$p->created_at]);
                }
            }
        }
        return response()->json(['result' =>$result]);
    }
}
