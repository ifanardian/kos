<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    
    public function __construct($user)
    {
        $this->user = $user;
        
        // dd($this->user); // Cek apakah objek user ada dan memiliki email
    }

    public function build()
    {
        // Log::info('Mengirim email ke: ' . $this->user->email);
        
        Log::info('Mengirim email ke: ' . ($this->user->email ?? 'Email kosong'));

        // if (empty($this->user->email)) {
        //     Log::error('Gagal mengirim email: Email kosong atau tidak valid.');
        //     return $this; // Jangan lanjutkan pengiriman jika email kosong
        // }
        $url_setpassword = route('password.create', ['email' => $this->user->email]);
        Log::info('URL set password: ' . $url_setpassword);

        return $this->subject('Reset Password Anda')
                    ->to($this->user->email) // Pastikan email valid
                    ->view('emails.forget_password')
                    ->with([
                        'email' => $this->user->email,
                        'url_setpassword' => $url_setpassword
                    ]);
    }

    // /**
    //  * Get the message envelope.
    //  */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Set Password Mail',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
