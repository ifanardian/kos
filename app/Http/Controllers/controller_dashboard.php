<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class controller_dashboard extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
    }
    public function index()
    {
        // if (Auth::check()) {
            return view('dashboard');
        // } else {
        //     return view('login');
        // }    
    }
}
