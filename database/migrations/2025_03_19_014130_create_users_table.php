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
        Schema::create('users', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->foreignId('id_penyewa')->nullable()->reference('id_penyewa')->on('penyewa')->onDelete('set null');
            $table->string('password')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->string('role', 10)->default('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
