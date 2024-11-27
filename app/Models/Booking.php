<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    protected $table = 'bookings';  
    protected $fillable = ['tipe', 'nama_lengkap', 'no_hp', 'email', 'alamat', 'ktp', 'tanggal_pesan'];
}
