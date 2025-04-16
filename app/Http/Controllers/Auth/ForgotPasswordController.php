<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    public function showCreatePasswordForm(Request $request)
    {
        $email = $request->query('email');
        
        return view('auth.register', compact('email'));
    }

    /**
     * Store the new password into the database.
     */
    public function storeNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Users::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Your password has been set. Please log in.');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // dd($request->email);
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Ambil pengguna berdasarkan email
        $user = Users::where('email', $request->email)->first();

        Log::info('Email yang diterima dari request: ' . $request->email);
        Log::info('Hasil query user:', ['user' => $user]);

        if (!$user) {
            Log::error('Email tidak ditemukan: ' . $request->email);
            return redirect()->back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.']);
        }

        Log::info('Email ditemukan di database: ' . $request->email);

        if (empty($request->email)) {
            Log::error('Email pengguna tidak valid.');
            return back()->withErrors(['email' => 'Email pengguna tidak valid.']);
        }

        try {
            Mail::to($request->email)->send(new ForgotPasswordMail($user));
            Log::info('Email reset password telah dikirim ke: ' . $user->email);
            return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan saat mengirim email.']);
        }

        return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }


    
}
