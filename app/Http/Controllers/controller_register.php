<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\model_kos;

class controller_register extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function actionRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user,username',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email'=> 'required|email'
        ]);
    
        $existingUser = DB::table('user')->where('username', $request->username)->first();
    
        if ($existingUser) {
            return back()->withErrors(['usernameError' => 'Akun ini sudah memiliki akun.']);
        }

        DB::table('user')->insert([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email'=> $request->email,
        ]);
    
        Session::flush();
        
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}
