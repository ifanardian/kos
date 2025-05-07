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
        if (!$payment->isEmpty()) {
            foreach ($payment as $p){
                $selisih = (now()->diffInMinutes($p->created_at))*-1;
                if($selisih > 1440 ){
                    DB::Delete(function () {
                        $penyewa = Penyewa::where('id_penyewa', $p->id_penyewa)->first();
                        Users::where('email', $penyewa->email)->delete();
                        Payment::where('id_penyewa', $p->id_penyewa)->delete();
                        Booking::where('id_booking', $penyewa->id_booking)->update(['status' => 'CANCELED']);
                        Kamar::where('id_kamar', $penyewa->no_kamar)->update(['status' => 'F']);
                        $penyewa->delete();
                    });
                    return response()->json(['result' =>'pembayaran sudah lebih dari 24 jam']);
                }
            }
            return response()->json(['result' =>'pembayaran belum lebih dari 24 jam']);
        }
        return response()->json(['result' =>'tidak ada pembayaran yang belum terverifikasi']);
    }
}
