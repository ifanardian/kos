<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'email',
        'periode_tagihan',
        'total_tagihan',
        'tanggal_pembayaran',
        'bukti_pembayaran',
    ];
}
