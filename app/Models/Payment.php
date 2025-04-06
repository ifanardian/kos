<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = ['id_penyewa', 'periode_tagihan'];
    public $incrementing = false;

    protected $fillable = [
        'id_penyewa',
        'periode_tagihan',
        'id_kamar',
        'total_tagihan',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'bukti_pembayaran',
        'status_verifikasi',
    ];
}
