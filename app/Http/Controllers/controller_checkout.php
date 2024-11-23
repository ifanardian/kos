<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Booking;

use Illuminate\Http\Request;

class controller_checkout extends Controller
{
    public function checkout()
    {
        if (Auth::check()) {
            return view('confirmation');
        } else {
            return view('login');
        }    }
}
