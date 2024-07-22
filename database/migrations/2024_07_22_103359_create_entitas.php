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
        Schema::create('entitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_latin')->nullable();
            $table->string('nama_daerah')->nullable();
            $table->bigInteger('family_id')->unsigned()->nullable();
            $table->bigInteger('jenis_id')->unsigned()->nullable();
            $table->bigInteger('kategori_id')->unsigned()->nullable();
            $table->string('url_qr')->nullable();
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('family');
            $table->foreign('jenis_id')->references('id')->on('jenis');
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entitas');
    }
};
