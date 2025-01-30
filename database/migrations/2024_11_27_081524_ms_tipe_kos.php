<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        schema::create('ms_tipe_kos', function (Blueprint $table) {
            $table->id();
            $table->double('harga');
            $table->integer('bulan');
            $table->string('deskripsi');
            $table->timestamps();
        });
        DB::table('ms_tipe_kos')->insert([
            ['harga' => '400000','bulan'=> 1, 'deskripsi' => 'Bulanan', 'created_at' => now(), 'updated_at' => now()],
            ['harga' => '1000000','bulan'=> 12 , 'deskripsi' => 'Tahunan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_tipe_kos');
    }
};
