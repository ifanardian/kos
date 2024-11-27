<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function showCheckout()
    {
        return view('Booking.booking');
    }

    public function store(Request $request)
    {
        // dd($request->all(), $request->file('ktp_file_path'), $request->tipe);
        $request->validate([
            'tipe' => 'required',
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'tanggal_pesan' => 'required',
            'ktp' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);
        $ktp = $request->file('ktp');
        $fileName =$request->email.'-'.time().'.'.$ktp->extension();
        $filePath = $ktp->storeAs('ktp', $fileName, 'local');
        
        // Simpan file KTP dan data booking
        // $ktpPath = $request->file('ktp')->store('uploads/ktp');

        Booking::create([
            'tipe' => $request->tipe,
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tanggal_pesan' => $request->tanggal_pesan,
            'ktp' => $fileName,
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking berhasil!');
    }
}
