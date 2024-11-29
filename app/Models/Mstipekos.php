<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mstipekos extends Model
{
    protected $table = 'ms_tipe_kos';  
    protected $fillable = ['tipe_kos', 'harga', 'deskripsi'];
}
