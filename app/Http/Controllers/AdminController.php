<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        return view('admin.dashboard');
    }
}
