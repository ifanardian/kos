<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Mail\SetPasswordMail;
use App\Models\Booking;
use App\Models\MsTipeKos;
use App\Models\Penyewa;
use App\Models\Users;
use App\Models\Payment;
use App\Models\Kamar;

class AdminBookingController extends Controller
{
    public function verifikasiBooking()
    {
        $pending = Booking::where('status', 'PENDING')->orderBy('created_at', 'asc')->get();
        $approved = Booking::where('status', 'APPROVED')->orderBy('created_at', 'asc')->get();
        $rejected = Booking::where('status', 'REJECTED')->orderBy('created_at', 'asc')->get();
        $canceled = Booking::where('status', 'CANCELED')->orderBy('created_at', 'asc')->get();
        $tipe = MsTipeKos::all();
        
        return view('admin.admin-verifikasi', compact('pending', 'approved', 'rejected', 'tipe', 'canceled'));
    }
    
    public function showKtp($filename)
    {
        if (Storage::exists("ktp/$filename")) {
            return response()->file(storage_path("\app\private\ktp\\$filename"));
        }
        abort(404);
    }

    public function updateStatusBooking(Request $request)
    { 
        $request->validate([
            'id_booking' => 'required|integer',
            'status' => 'required|string',
            'id_kamar' => 'nullable|integer',
            'alasan_ditolak' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $booking = Booking::findOrFail($request->id_booking);
            $booking->status = $request->status;

            if ($request->status === "APPROVED") {
                $penyewa = Penyewa::create([
                    'email' => $booking->email,
                    'nama' => $booking->nama_lengkap,
                    'no_telepon' => $booking->no_hp,
                    'no_kamar' => $request->id_kamar,
                    'tipe_kos' => $booking->tipe_kos,
                    'alamat' => $booking->alamat,
                    'ktp' => $booking->ktp,
                    'status_penyewaan' => 1,
                    'tanggal_booking' => $booking->created_at->format('Y-m-d'),
                    'tanggal_menyewa' => $booking->periode_penempatan,
                    'tanggal_jatuh_tempo' => $booking->periode_penempatan,
                    'tanggal_berakhir' => null,
                ]);
                Users::create([
                    'id_penyewa' => $penyewa->id_penyewa,
                    'email' => $booking->email,
                    'password' => null,
                ]);

                $tipekos = MsTipeKos::findOrFail($booking->tipe_kos);
                Payment::create([
                    'id_kamar' => $request->id_kamar,
                    'id_penyewa' => $penyewa->id_penyewa,
                    'periode_tagihan' => $booking->periode_penempatan,
                    'total_tagihan' => $tipekos->harga,
                ]);
                
                Kamar::where('id_kamar', $request->id_kamar)->update(['status' => 'T']);
                Mail::to($booking->email)->send(new SetPasswordMail($booking, 'approved', null));
            }

            if ($request->status === "REJECTED") {
                Mail::to($booking->email)->send(new SetPasswordMail($booking, 'rejected', $request->alasan_ditolak));
            }

            $booking->save();
        });

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }
}
