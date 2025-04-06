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
        Schema::create('ms_panorama', function (Blueprint $table) {
            $table->id('id_panorama');
            $table->string('text', 30);
            $table->string('namafile', 100);
            $table->string('hfov', 11)->default('0');
            $table->string('pitch', 11)->default('0');
            $table->string('yaw', 11)->default('0');
            $table->boolean('default')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_panorama');
    }
};
