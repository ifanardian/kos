<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Booking;

use Illuminate\Http\Request;

class controller_booking extends Controller
{
    public function showCheckout(Request $request)
    {
        // Ambil tipe dari parameter request
        $tipe = $request->query('tipe');
        $harga = $tipe === 'Tahunan' ? 4500000 : 400000;

        return view('checkout', compact('tipe', 'harga'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'ktp' => 'required|mimes:jpg,jpeg|max:2048',
        ]);

        // Simpan file KTP dan data booking
        $ktpPath = $request->file('ktp')->store('uploads/ktp');

        Booking::create([
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'ktp_file_path' => $ktpPath,
        ]);

        return redirect()->route('confirmation')->with('success', 'Booking berhasil!');
    }

    // public function showCheckout(Request $request)
    // {
    //     // Retrieve the booking data based on the selected tipe from the request
    //     $tipe = $request->query('tipe');
    //     $booking = Booking::where('tipe', $tipe)->first();

    //     return view('checkout', compact('booking'));
    // }
}
