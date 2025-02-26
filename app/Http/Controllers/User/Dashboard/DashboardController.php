<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // if (Auth::check()) {
        $panorama = DB::table('ms_panorama')->get();
        return view('user.dashboard.dashboard',compact('panorama'));
        // } else {
        //     return view('login');
        // }    
    }
}
