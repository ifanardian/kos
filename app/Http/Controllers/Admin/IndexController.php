<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function showIndex(){
        $totalKamar = DB::table('kamar')->count();
        $kamarTerisi = DB::table('kamar')->where('status', 'T')->count();
        $kamarKosong = $totalKamar - $kamarTerisi;
        $totalPending = DB::table('bookings')->where('status', 'PENDING')->count();
        return view('admin.dashboard',compact('totalKamar','kamarTerisi','kamarKosong', 'totalPending'));
    }
}
