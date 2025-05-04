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
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id_payments');
            $table->Integer('id_penyewa');
            $table->date('periode_tagihan');
            $table->string('id_kamar');
            $table->string('total_tagihan');
            $table->string('metode_pembayaran')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->boolean('status_verifikasi')->nullable();
            $table->timestamps();

            $table->primary(['id_payments','id_penyewa', 'periode_tagihan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
