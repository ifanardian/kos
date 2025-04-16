<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MsPanorama;

class MsPanoramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MsPanorama::create([
            'text' => 'Tempat Masuk',
            'namafile'=> '1743867655_panorama.jpeg',
            'hfov'=> '120',
            'pitch' => '-5.5',
            'yaw' => '170',
            'default' => 1,
        ]);
        MsPanorama::create([
            'text' => 'Jemuran',
            'namafile'=> '1743868072_jmr.jpeg',
            'hfov'=> '120',
            'pitch' => '-8.5',
            'yaw' => '-26',
            'default' => 0,
        ]);
        MsPanorama::create([
            'text' => 'Kamar Mandi',
            'namafile'=> '1743868168_km.jpeg',
            'hfov'=> '120',
            'pitch' => '-9',
            'yaw' => '170',
            'default' => 0,
        ]);
        MsPanorama::create([
            'text' => 'Tampak Depan',
            'namafile'=> '1744037074_dpn.JPG',
            'hfov'=> '107',
            'pitch' => '-1.5',
            'yaw' => '-174',
            'default' => 0,
        ]);
    }
}
