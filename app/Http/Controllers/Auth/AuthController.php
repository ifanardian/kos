<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Penyewa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\logout;


class AuthController extends Controller
{
    public function viewLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } 
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $penyewa = Penyewa::where('email', $request->email)
                  ->orderBy('created_at', 'desc') 
                  ->first(); 
                  
        // Jika email tidak terdaftar di tabel penyewa
        // if (!$penyewa) {
        //     return back()->withErrors([
        //         'error' => 'Email tidak terdaftar.',
        //     ]);
        // }
        
        if ($penyewa && !$penyewa->status_penyewaan) {
            return back()->withErrors([
                'error' => 'Akun Anda nonaktif dan tidak bisa login.',
            ]);
        }
        
        if (Auth::attempt($credentials)) {
            return redirect(Auth::user()->isAdmin() ? '/admin' : '/');
        }
        Auth::logout();
        return back()->withErrors([
            
            'error' => 'Email atau password salah.',
        ]);
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('register');
    }

    public function actionRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email'=> 'required|email'
        ]);
        
        $existingUser = Users::where('username', $request->username)->first();
        
        if ($existingUser) {
            return back()->withErrors(['usernameError' => 'Akun ini sudah memiliki akun.']);
        }

        Users::insert([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email'=> $request->email,
        ]);
    
        Session::flush();
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function logout()
    {
        
        Auth::guard('web')->logout(); 
        Session::flush();
        return redirect()->route('dashboard');
    }
}
