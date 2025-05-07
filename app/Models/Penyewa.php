<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;

    protected $table = 'penyewa';
    protected $primaryKey = 'id_penyewa';

    protected $fillable = [
        'id_booking',
        'email',
        'nama',
        'no_telepon',
        'no_kamar',
        'tipe_kos',
        'alamat',
        'ktp',
        'tanggal_menyewa',
        'tanggal_jatuh_tempo',
        'tanggal_booking',
        'status_penyewaan',
        'tanggal_berakhir',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'no_kamar', 'id_kamar');
    }
    
    public function tipeKos()
    {
        return $this->belongsTo(MsTipeKos::class, 'tipe_kos', 'id_tipe_kos');
    }
}
