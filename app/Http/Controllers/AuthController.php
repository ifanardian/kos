<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function viewLogin()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } 
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect('dashboard');
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
        // dd($request->all());
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


    public function logout(){
        Session::flush();
        return redirect()->route('dashboard');
    }
}
