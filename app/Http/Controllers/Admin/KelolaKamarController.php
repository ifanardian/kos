<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\MsTipeKos;

class KelolaKamarController extends Controller
{
    public function ShowIndex(){
        $kamar = Kamar::with(['penyewa.tipeKos'])->orderBy('id_kamar', 'ASC')->get();
        $msTipe = MsTipeKos::all();
        return view('admin.kamar.kamar', compact('kamar', 'msTipe'));
    }

    public function PostTipeLangganan(Request $request){
        $request->validate([
            'harga' => 'required|numeric',
            'bulan' => 'required|numeric',
            'deskripsi' => 'required|string'
        ]);

        MsTipeKos::create([
            'harga' => $request->harga,
            'bulan' => $request->bulan,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back();
    }

    public function PostKamar(Request $request){
        $request->validate([
            'id_kamar' => 'required|numeric',
        ]);

        Kamar::create([
            'id_kamar' => $request->id_kamar,
        ]);

        return redirect()->back();
    }

    public function updateTipeKos(Request $request)
    {
        $request->validate([
            'harga' => 'required|numeric',
            'id_tipe_kos' => 'required|numeric',
        ]);

        MsTipeKos::where('id_tipe_kos', $request->id_tipe_kos)
            ->update(['harga' => $request->harga]);

        return redirect()->back()->with('success', 'Harga berhasil diperbarui.');
    }
}
