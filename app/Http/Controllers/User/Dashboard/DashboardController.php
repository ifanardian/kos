<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // if (Auth::check()) {
            return view('user.dashboard.dashboard');
        // } else {
        //     return view('login');
        // }    
    }
}
