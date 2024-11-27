<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('tipe'); // Tipe pemesanan (BULANAN/TAHUNAN)
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->string('email');
            $table->text('alamat');
            $table->string('ktp'); // Path file upload KTP
            $table->date('tanggal_pesan');
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
