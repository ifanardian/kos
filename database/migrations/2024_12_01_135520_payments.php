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
            $table->string('email');
            $table->date('periode_tagihan');
            $table->string('total_tagihan');
            $table->string('metode_pembayaran')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->boolean('status_verifikasi')->nullable()->default(null);
            $table->timestamps();

            $table->primary(['email', 'periode_tagihan']);
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
