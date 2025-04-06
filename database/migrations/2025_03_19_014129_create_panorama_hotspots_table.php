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
        Schema::create('panorama_hotspots', function (Blueprint $table) {
            $table->id('id_hotspot');
            $table->foreignId('id_panorama')->references('id_panorama')->on('ms_panorama')->onDelete('cascade');
            $table->string('pitch', 6)->default('0');
            $table->string('yaw', 6)->default('0');
            $table->integer('scene');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panorama_hotspots');
    }
};
