<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mstipekos extends Model
{
    protected $table = 'ms_tipe_kos';  
    protected $primaryKey = 'id';
    protected $fillable = ['harga', 'bulan', 'deskripsi'];
}
