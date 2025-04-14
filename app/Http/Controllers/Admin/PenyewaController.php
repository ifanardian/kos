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
use App\Models\{Penyewa, Mstipekos, Kamar, Users, Payment};


class PenyewaController extends Controller
{
    public function penyewa()
    {
        // $penghuniAktif = Penyewa::whereNull('tanggal_berakhir')->get();
        $penghuniAktif = Penyewa::where('status_penyewaan', 1)
            ->whereNull('tanggal_berakhir')
            ->get();
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
            'email' => 'required|email|unique:users,email',
            'nama' => 'required|string',
            'no_telepon' => 'required|string',
            'tipe_kos' => 'required|string',
            'alamat' => 'required|string',
            'tanggal_booking' => 'required|date',
            'tanggal_menyewa' => 'required|date',
            'no_kamar' => 'required',
            'status_penyewaan' => 'required|boolean',
            'ktp' => 'required|mimes:jpeg,png,jpg|max:2048',
        ]);
        

        DB::beginTransaction();

        try {
            // Simpan file KTP
            $fileName = $request->email . '-' . time() . '.' . $request->file('ktp')->extension();
            $request->file('ktp')->storeAs('ktp', $fileName);

            $penyewa = Penyewa::create([
                'email' => $request->email,
                'nama' => $request->nama,
                'no_telepon' => $request->no_telepon,
                'no_kamar' => $request->no_kamar,
                'tipe_kos' => $request->tipe_kos,
                'alamat' => $request->alamat,
                'ktp' => $fileName,
                'status_penyewaan' => 1,
                'tanggal_booking' => $request->tanggal_booking,
                'tanggal_menyewa' => $request->tanggal_menyewa,
                'tanggal_jatuh_tempo' => $request->tanggal_menyewa,
                'tanggal_berakhir' => null,
            ]);

            // Update status kamar menjadi Terisi (T)
            Kamar::where('id_kamar', $request->no_kamar)->update(['status' => 'T']);

            // Buat akun user
            Users::create([
                'email' => $penyewa->email,
                'id_penyewa' => $penyewa->id_penyewa,
                'password' => null, // kosongkan agar harus setel ulang 
                'role' => 'user',
            ]);

            // Ambil harga kos berdasarkan tipe
            $hargaKos = DB::table('ms_tipe_kos')->where('id_tipe_kos', $request->tipe_kos)->value('harga');

            // Tambah data pembayaran pertama
            Payment::create([
                'id_penyewa' => $penyewa->id_penyewa,
                'periode_tagihan' => $penyewa->tanggal_menyewa, // atau booking tergantung logika kamu
                'id_kamar' => $penyewa->no_kamar,
                'total_tagihan' => $hargaKos,
                'metode_pembayaran' => null,
                'tanggal_pembayaran' => null,
                'bukti_pembayaran' => null,
                'status_verifikasi' => null
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Penyewa baru berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menambahkan penyewa: ' . $e->getMessage());
        }
    }


}