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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kategori_kunjungan_id')->unsigned(); // FK
            $table->string('nama');
            $table->string('email');
            $table->bigInteger('alamat_id')->unsigned(); // FK
            $table->bigInteger('jenis_pengunjung_id')->unsigned(); // FK
            $table->bigInteger('hari_kunjungan_id')->unsigned(); // FK
            $table->bigInteger('waktu_kunjungan_id')->unsigned(); // FK
            $table->timestamps();

            $table->foreign('kategori_kunjungan_id')->references('id')->on('kategori_kunjungan'); // FK
            $table->foreign('alamat_id')->references('id')->on('alamat'); // FK
            $table->foreign('jenis_pengunjung_id')->references('id')->on('jenis_pengunjung'); // FK
            $table->foreign('hari_kunjungan_id')->references('id')->on('hari_kunjungan'); // FK
            $table->foreign('waktu_kunjungan_id')->references('id')->on('waktu_kunjungan'); // FK
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
