<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\MsTipeKos;

class AdminController extends Controller
{
    public function index()
    {
        $hargaBulanan = MsTipeKos::where('bulan', 1)->first();
        $hargaTahunan = MsTipeKos::where('bulan', 12)->first();
        return view('admin.kelola_kamar', compact('hargaBulanan', 'hargaTahunan'));
    }

    public function updateTipeKos(Request $request)
    {
        $request->validate([
            'harga' => 'required|numeric|min:100000',
            'tipe' => 'required|in:bulanan,tahunan',
        ]);

        // Tentukan bulan berdasarkan tipe
        $bulan = $request->tipe === 'bulanan' ? 1 : 12;

        // Update harga berdasarkan bulan
        MsTipeKos::where('bulan', $bulan)->update(['harga' => $request->harga]);

        return redirect()->back()->with('success', 'Harga berhasil diperbarui.');
    }
    
    public function dashboardAdmin()
    {
        return view('admin.dashboard');
    }

    public function penyewaAdmin()
    {
        return view('admin.penyewa');
    }

    public function kamarAdmin()
    {
        return view('admin.kamar');
    }

    public function riwayatAdmin()
    {
        return view('admin.riwayat');
    }

    public function verifikasiAdmin()
    {
        return view('admin.verifikasi');
    }

    public function websiteAdmin()
    {
        return view('admin.website');
    }

    public function booking()
    {
        return view('booking');
    }

    public function payment()
    {
        return view('payment');
    }

    public function tagihan()
    {
        return view('tagihan');
    }

    public function password()
    {
        return view('auth.register');
    }
}
