<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function ShowIndex(){
        $kamar = DB::select("
            SELECT k.id_kamar, k.status, p.email, p.nama, p.tanggal_jatuh_tempo, t.deskripsi, t.harga
            FROM kamar k
            LEFT JOIN penyewa p ON k.id_kamar = p.no_kamar AND p.status_penyewaan = 1
            LEFT JOIN ms_tipe_kos t ON p.tipe_kos = t.id
            ORDER BY k.id_kamar ASC
        ");
        $msTipe = DB::select("
            SELECT * 
            FROM ms_tipe_kos
        ");
        // dd($kamar, $msTipe);
        return view('admin.kamar.kamar',compact('kamar','msTipe'));
    }
}
