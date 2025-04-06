<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct($booking,$status,$alasan_ditolak)
    {
        $this->booking = $booking;
        $this->status = $status;
        $this->alasan_ditolak = $alasan_ditolak;
    }

    public function build()
    {
        // dd($this->status);
        if($this->status == "rejected"){
            return $this->subject('Pemesanan Anda Ditolak')
                    ->view('emails.reject_booking')
                    ->with([
                        'email' => $this->booking->email,
                        'alasan_ditolak' => $this->alasan_ditolak,
                    ]);
        }
        else if($this->status == "approved"){
            // dd($this->status);
            $url_setpassword = route('password.create', ['email' => $this->booking->email]);
            $url_payment = route('tagihan');

            return $this->subject('Buat Password untuk Akun Anda')
                        ->view('emails.set_password')
                        ->with([
                            'email' => $this->booking->email,
                            'url_setpassword' => $url_setpassword,
                            'url_payment' => $url_payment,
                        ]);
        }   
    }
}
