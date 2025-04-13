<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use carbon\carbon;
use Illuminate\Support\Facades\DB;
use app\Models\MsTipeKos;

class AlertPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userdetail;
    public function __construct($user)
    {
        $this->userdetail = $user;
    }
    public function build()
    {
    //fix id_tipe_kos
       $sisa = \Carbon\Carbon::now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($this->userdetail->tanggal_jatuh_tempo)->startOfDay());
       $langganan = DB::table('ms_tipe_kos')
                    ->where('id_tipe_kos', $this->userdetail->tipe_kos)
                    ->first();
       

        return $this->view('emails.alertpayment')
                    ->with(['user' => $this->userdetail, 'sisa' => $sisa , 'langganan' => $langganan])
                    ->subject("Pengingat Pembayaran");
    }
}
