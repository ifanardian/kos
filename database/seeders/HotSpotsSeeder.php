<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PanoramaHotspot; 

class HotSpotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PanoramaHotspot::create([
            'id_panorama' => '1',
            'pitch' => '0',
            'yaw' => '-102.5',
            'scene' => '3',
        ]);
        PanoramaHotspot::create([
            'id_panorama' => '1',
            'pitch' => '0',
            'yaw' => '76.5',
            'scene' => '2',
        ]);
        PanoramaHotspot::create([
            'id_panorama' => '2',
            'pitch' => '-14.5',
            'yaw' => '-6',
            'scene' => '1',
        ]);
        PanoramaHotspot::create([
            'id_panorama' => '2',
            'pitch' => '0',
            'yaw' => '-6.5',
            'scene' => '3',
        ]);
        PanoramaHotspot::create([
            'id_panorama' => '3',
            'pitch' => '-19.5',
            'yaw' => '-142',
            'scene' => '1',
        ]);
        PanoramaHotspot::create([
            'id_panorama' => '3',
            'pitch' => '0',
            'yaw' => '-143.5',
            'scene' => '2',
        ]);
        PanoramaHotspot::create([
            'id_panorama' => '1',
            'pitch' => '0',
            'yaw' => '72',
            'scene' => '4',
        ]);PanoramaHotspot::create([
            'id_panorama' => '4',
            'pitch' => '-10.5',
            'yaw' => '-167.5',
            'scene' => '1',
        ]);

    }
}
