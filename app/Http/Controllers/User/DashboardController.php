<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MsPanorama;
use App\Models\MsTipeKos;
use App\Models\Gambar;

class DashboardController extends Controller
{
    public function index()
    {
        $panorama = MsPanorama::with('hotspots.scenePanorama:id_panorama,text') 
        ->get();
        $MsTipeKos = MsTipeKos::all();
        $gambar = Gambar::all();
        return view('user.dashboard.dashboard',compact('panorama','MsTipeKos', 'gambar'));
    }
}
