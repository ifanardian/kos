<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_kos; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class Login extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();  

            Session::put('user', [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email, 
            ]);
            
            Log::info('Login berhasil untuk pengguna', ['username' => $user->username]);
            
            return redirect('dashboard')->with('success', 'Login berhasil!'); 
        } else {
            Log::warning('Percobaan login gagal untuk username', ['username' => $request->username]);
            return back()->withErrors(['loginError' => 'Username atau password salah.']);
        }
    }

    public function actionlogout()
    {
        Session::forget('user');
        Auth::logout(); 
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.'); 
    }
}
