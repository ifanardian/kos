<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanoramaHotspot extends Model
{
    use HasFactory;

    protected $table = 'panorama_hotspots';
    protected $primaryKey = 'id_hotspot';

    protected $fillable = [
        'id_panorama',
        'pitch',
        'yaw',
        'scene',
    ];

    public function panorama()
    {
        return $this->belongsTo(MsPanorama::class, 'id_panorama');
    }
    
    public function scenePanorama()
    {
        return $this->belongsTo(MsPanorama::class, 'scene', 'id_panorama');
    }
}
