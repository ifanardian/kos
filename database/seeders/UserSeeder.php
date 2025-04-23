<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::create([
            'email' => 'rumahkosfortuna@gmail.com',
            'password' => Hash::make('rumahkosfortuna1975'),
            'role' => 'admin',
        ]);
    }
}
