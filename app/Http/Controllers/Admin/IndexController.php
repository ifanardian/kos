<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Booking;

class IndexController extends Controller
{
    public function showIndex(){
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('status', 'T')->count();
        $kamarKosong = $totalKamar - $kamarTerisi;
        $totalPending = Booking::where('status', 'PENDING')->count();
        return view('admin.dashboard.dashboard',compact('totalKamar','kamarTerisi','kamarKosong', 'totalPending'));
    }
}
