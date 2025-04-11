<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gambar extends Model
{
    
    use HasFactory;
    protected $table = 'gambar';
    protected $primaryKey = 'id_gambar';

    protected $fillable = [
        'nama_gambar',
    ];
}
