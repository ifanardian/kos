<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Mstipekos;
use App\Models\Penyewa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;


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
        
        if($booking->status == "APPROVED"){
            // dd($booking->ktp);
            // Mail::to($booking->email)->send(new InvoiceMail($booking));
            Penyewa::create([
                'email' => $booking->email,
                'nama' => $booking->nama_lengkap,
                'no_telepon' => $booking->no_hp,
                'no_kamar' => '1',
                'ktp' => $booking->ktp,
                'status' => 'BELUM LUNAS',
                'tanggal_menyewa' => $booking->tanggal_pesan,
                'tanggal_jatuh_tempo' => date('Y-m-d', strtotime($booking->tanggal_pesan . ' + 1 month')),
                'tanggal_berakhir' =>null,
            ]);
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
