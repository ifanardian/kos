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

    public function penyewaAdmin()
    {
        return view('admin.penyewa');
    }

    public function kamarAdmin()
    {
        return view('admin.kamar');
    }

    public function riwayatAdmin()
    {
        return view('admin.riwayat');
    }

    public function verifikasiAdmin()
    {
        return view('admin.verifikasi');
    }

    public function websiteAdmin()
    {
        return view('admin.website');
    }

    public function booking()
    {
        return view('booking');
    }

    public function payment()
    {
        return view('payment');
    }

    public function tagihan()
    {
        return view('tagihan');
    }

    public function password()
    {
        return view('auth.register');
    }
}
