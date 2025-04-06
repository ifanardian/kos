<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';
    public $incrementing = false;

    protected $fillable = [
        'id_kamar',
        'status',
    ];

    public function penyewa()
    {
        return $this->hasOne(Penyewa::class, 'no_kamar', 'id_kamar')->where('status_penyewaan', 1);
    }
}
