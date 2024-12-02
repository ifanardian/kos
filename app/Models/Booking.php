<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    protected $table = 'bookings';  
    protected $fillable = ['tipe_kos', 'nama_lengkap', 'no_hp', 'email', 'alamat', 'ktp', 'periode_penempatan','note'];
}
