<?php

namespace App\Http\Controllers\User\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Mstipekos;

class BookingController extends Controller
{
    public function showCheckout()
    {
        $tipeKos = Mstipekos::all();
        // dd($tipeKos);
        return view('user.booking.booking', compact('tipeKos'));
    }

    public function store(Request $request)
    {
        // dd($request->note);
        $request->validate([
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'tipe_kos' => 'required',
            'alamat' => 'required',
            'periode_penempatan' => 'required',
            'note' => 'nullable',
            'ktp' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);
        $ktp = $request->file('ktp');
        $fileName =$request->email.'-'.time().'.'.$ktp->extension();
        $filePath = $ktp->storeAs('ktp', $fileName, 'local');
        
        // Simpan file KTP dan data booking
        // $ktpPath = $request->file('ktp')->store('uploads/ktp');

        Booking::create([
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'tipe_kos' => $request->tipe_kos,
            'alamat' => $request->alamat,
            'periode_penempatan' => $request->periode_penempatan,
            'note' => $request->note,
            'ktp' => $fileName,
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking berhasil!');
    }
}
