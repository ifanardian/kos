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
use App\Models\{Penyewa, Mstipekos, Kamar, Users};


class PenyewaController extends Controller
{
    public function penyewa()
    {
        $penghuniAktif = Penyewa::whereNull('tanggal_berakhir')->get();
        $penghuniRiwayat = Penyewa::whereNotNull('tanggal_berakhir')->get();
        $msTipe = Mstipekos::orderBy('id_tipe_kos', 'asc')->get();

        return view('admin.admin-penyewa.adminpenyewa', compact('penghuniAktif', 'penghuniRiwayat', 'msTipe'));
    }

    public function updatePenyewa(Request $request)
    {
        $request->validate([
            'id_penyewa' => 'required|integer',
            'nama' => 'required|string',
            'no_telepon' => 'required|string',
            'tipe_kos' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_menyewa' => 'required|date',
            'tanggal_berakhir' => 'nullable|date',
            'no_kamar' => 'required',
            'status_penyewaan' => 'required|boolean',
            'ktp' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);

        $penyewa = Penyewa::findOrFail($request->id_penyewa);
        
        if ($request->hasFile('ktp')) {
            $fileName = $request->email . '-' . time() . '.' . $request->file('ktp')->extension();
            $filePath = $request->file('ktp')->storeAs('ktp', $fileName);
            Storage::delete("ktp/$penyewa->ktp");
            $penyewa->ktp = $fileName;
        }

        if (!$request->status_penyewaan) {
            $penyewa->tanggal_berakhir = Carbon::now()->toDateString();
            Kamar::where('id_kamar', $penyewa->no_kamar)->update(['status' => 'F']);
            Users::where('email', $penyewa->email)->delete();
        }

        if ($penyewa->no_kamar != $request->no_kamar) {
            Kamar::where('id_kamar', $penyewa->no_kamar)->update(['status' => 'F']);
            Kamar::where('id_kamar', $request->no_kamar)->update(['status' => 'T']);
            $penyewa->no_kamar = $request->no_kamar;
        }

        $penyewa->update($request->except(['ktp', 'tanggal_berakhir']));
        
        return redirect()->back()->with('success', 'Data penyewa berhasil diperbarui.');
    }

    public function detailPenyewa($id)
    {
        return response()->json(Penyewa::findOrFail($id));
    }

    public function tambahPenyewa(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:penyewa',
            'nama' => 'required|string',
            'no_telepon' => 'required|string',
            'tipe_kos' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_booking' => 'required|date',
            'tanggal_menyewa' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
            'no_kamar' => 'required',
            'status_penyewaan' => 'required|boolean',
            'ktp' => 'required|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fileName = $request->email . '-' . time() . '.' . $request->file('ktp')->extension();
        $request->file('ktp')->storeAs('ktp', $fileName);

        $penyewa = new Penyewa();
        $penyewa->fill($request->except('ktp'));
        $penyewa->ktp = $fileName;
        $penyewa->save();

        Kamar::where('id_kamar', $request->no_kamar)->update(['status' => 'T']);

        // (Opsional) Tambahkan akun user juga jika perlu
        // User::create([
        //     'email' => $request->email,
        //     'password' => Hash::make('default123'), // default password
        //     'role' => 'penyewa',
        // ]);

        Users::create([
            'email' => $penyewa->email,
            'id_penyewa' => $penyewa->id, // pastikan 'id' adalah primary key dari penyewa
            'password' => null, // atau kosongkan agar wajib reset password
            'role' => 'user', // default sesuai struktur kamu
        ]);


        return redirect()->back()->with('success', 'Penyewa baru berhasil ditambahkan.');
    }

}