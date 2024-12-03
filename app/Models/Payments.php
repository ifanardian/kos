<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';
    protected $primaryKey = ['email', 'periode_tagihan'];
    protected $fillable = [
        'email',
        'periode_tagihan',
        'total_tagihan',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'bukti_pembayaran',
        'status_verifikasi',
        'created_at',
        'updated_at',
    ];
}
