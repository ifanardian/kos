<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penyewa extends Model
{
    protected $table = 'penyewa';
    protected $fillable = ['email', 'nama', 'no_telepon', 'no_kamar', 'status', 'periode', 'tanggal_menyewa', 'tanggal_jatuh_tempo', 'tanggal_berakhir','ktp'];  
}