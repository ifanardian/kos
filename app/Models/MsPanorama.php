<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsPanorama extends Model
{
    use HasFactory;

    protected $table = 'ms_panorama';
    protected $primaryKey = 'id_panorama';
    public $timestamps = false;

    protected $fillable = [
        'text',
        'namafile',
        'hfov',
        'pitch',
        'yaw',
        'default',
    ];

    public function hotspots()
    {
        return $this->hasMany(PanoramaHotspot::class, 'id_panorama');
    }
    
    
}
