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
        Schema::create('benih', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('stok')->nullable();
            $table->string('harga')->nullable();
            $table->string('netto')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('url_gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benih');
    }
};
