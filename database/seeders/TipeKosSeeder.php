<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MsTipeKos; 

class TipeKosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MsTipeKos::create([
            'harga' => 400000,
            'bulan' => 1,
            'deskripsi' => 'Bulanan',
        ]);
        MsTipeKos::create([
            'harga' => 4500000,
            'bulan' => 12,
            'deskripsi' => 'Tahunan',
        ]);
    }
}
