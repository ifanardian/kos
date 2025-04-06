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
        Schema::create('penyewa', function (Blueprint $table) {
            $table->id('id_penyewa');
            $table->string('email');
            $table->string('nama');
            $table->string('no_telepon');
            $table->string('no_kamar')->nullable();
            $table->string('tipe_kos');
            $table->text('alamat');
            $table->string('ktp');
            $table->date('tanggal_menyewa');
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_booking');
            $table->boolean('status_penyewaan')->default(0);
            $table->date('tanggal_berakhir')->nullable();
            $table->timestamps();
            
            $table->foreign('no_kamar')->references('id_kamar')->on('kamar')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewa');
    }
};
