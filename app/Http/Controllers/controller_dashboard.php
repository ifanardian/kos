<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class controller_dashboard extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('dashboard');
        } else {
            return view('login');
        }    }
}
