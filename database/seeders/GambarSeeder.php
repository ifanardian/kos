<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

use App\Models\Gambar;

class GambarSeeder extends Seeder
{
    public function run(): void
    {   
        foreach (File::files(database_path('seeders/gambar')) as $file) {
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getFilename());
        
            File::copy($file->getPathname(), public_path('images/grid/' . $filename));
            Gambar::create([
                'nama_gambar' => $filename
            ]);
        }
    }
}
