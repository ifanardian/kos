<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsTipeKos extends Model
{
    use HasFactory;

    protected $table = 'ms_tipe_kos';
    protected $primaryKey = 'id_tipe_kos';

    protected $fillable = [
        'harga',
        'bulan',
        'deskripsi',
    ];
}
