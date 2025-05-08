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
    {
        $payment = Payment::whereNull('status_verifikasi')->whereNull('metode_pembayaran')->get();
        $result = [
            'message' => 'tidak ada pembayaran yang belum terverifikasi',
            'vercel'  => now(),
            'result'  => []
        ];

        if (!$payment->isEmpty()) {
            $isExpired = false;
            foreach ($payment as $p) {
                $selisih = now()->diffInMinutes($p->created_at)*-1;
                $result['result'][] = [
                    'selisih' => $selisih,
                    'created' => $p->created_at,
                ];

                if ($selisih > 1440) {
                    $isExpired = true;
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
                }
            }

            if ($isExpired) {
                $result['message'] = 'Ada pembayaran yang sudah lebih dari 24 jam';
            } else {
                $result['message'] = 'pembayaran belum lebih dari 24 jam';
            }
        }

        return response()->json($result);
    }

}
