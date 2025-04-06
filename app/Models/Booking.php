<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'tipe_kos',
        'nama_lengkap',
        'no_hp',
        'email',
        'alamat',
        'ktp',
        'periode_penempatan',
        'note',
        'status',
    ];
}
