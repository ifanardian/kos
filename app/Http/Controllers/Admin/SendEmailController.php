<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class SendEmailController extends Controller
{
    public function sendInvoice()
    {
        // $user = User::find($request->user_id); // Ambil data user

        Mail::to("muhammad.ifan371@gmail.com")->send(new InvoiceMail("asd"));

        return response()->json(['message' => 'Email berhasil dikirim!']);
    }
}
