<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;

use App\Mail\SetPasswordMail;

use App\Models\Booking;
use App\Models\Mstipekos;
use App\Models\Penyewa;
use App\Models\Users;
use App\Models\Payments;


class ConfirmBookingController extends Controller
{
    // public function index()
    // {
    //     $data = Booking::all();

    //     return view('admin.confirm-booking.index', compact('data'));   
    // }

    public function verifikasiBooking()
    {
        $data = Booking::orderByRaw("FIELD(status, 'PENDING') DESC")->orderBy('created_at', 'asc')->get();
        $tipe = Mstipekos::all();
        return view('admin.admin-verifikasi', compact('data', 'tipe'));
    }

    public function showKtp($filename)
    {
        if (Storage::disk('local')->exists('ktp/' . $filename)) {
            // Menyajikan file secara aman
            $file = Storage::disk('local')->get('ktp/' . $filename);
            return Response::make($file, 200, [
                'Content-Type' => 'image/jpeg',  // Sesuaikan dengan tipe file
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]);
        }
        abort(404);
    }

    public function updateStatusBooking(Request $request)
    {
        $booking = Booking::find($request->id);
        $booking->status = $request->status;
        
        if ($booking->status == "APPROVED") {
            // Add user to 'users' table with null password initially
            Users::create([
                'email' => $booking->email,
                'password' => null, // Password akan diatur oleh user
            ]);

            Penyewa::create([
                'email' => $booking->email,
                'nama' => $booking->nama_lengkap,
                'no_telepon' => $booking->no_hp,
                'no_kamar' => $request->room_number,
                'tipe_kos' => $booking->tipe_kos,
                'alamat' => $booking->alamat,
                'ktp' => $booking->ktp,
                'tanggal_booking' => $booking->created_at->format('Y-m-d'),
                'tanggal_menyewa' => $booking->periode_penempatan,
                'tanggal_jatuh_tempo' => date('Y-m-d', strtotime($booking->periode_penempatan . ' + 1 month')),
                'tanggal_berakhir' => null,
            ]);
            
            $tipekos = Mstipekos::where('id', $booking->tipe_kos)->first();
            Payments::create([
                'email' => $booking->email,
                'periode_tagihan' => $booking->periode_penempatan,
                'total_tagihan' => $tipekos->harga,
            ]);
            Mail::to($booking->email)->send(new SetPasswordMail($booking));

        }

        $booking->save();
        return redirect()->back();
    }

    public function penyewa()
    {
        $data = Penyewa::all();
        return view('admin.admin-penyewa', compact('data'));
    }
}
