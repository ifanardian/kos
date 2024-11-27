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
        schema::create('ms_kos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kos');
            $table->string('alamat');
            $table->string('deskripsi');
            $table->string('fasilitas');
            $table->string('harga');
            $table->string('tipe_kos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_kos');
    }
};
