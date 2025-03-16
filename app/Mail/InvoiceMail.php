<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userdetail; // Data untuk email

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $status)
    {
        $this->userdetail = $user;
        $this->userdetail->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->userdetail->status == '1' ? 'Pembayaran Berhasil' : 'Pembayaran Gagal';
        return $this->view('emails.invoice')
                    ->with(['user' => $this->userdetail, 'status' => $this->userdetail->status])
                    ->subject($subject);
    }
}
