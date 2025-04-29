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
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->bigInteger('usia_id')->unsigned(); // FK
            $table->bigInteger('jenis_kelamin_id')->unsigned(); // FK
            $table->string('asal_instansi');
            $table->bigInteger('pekerjaan_id')->unsigned(); // FK
            $table->bigInteger('kategori_informasi_id')->unsigned(); // FK
            $table->bigInteger('pilihan_pertanian_id')->unsigned()->nullable(); // FK
            $table->bigInteger('pendidikan_id')->unsigned(); // FK
            $table->bigInteger('jenis_pengunjung_id')->unsigned(); // FK
            $table->integer('jumlah_orang')->nullable();
            $table->date('tanggal_kunjungan');
            $table->text('tujuan_kunjungan');
            $table->string('url_foto_ktp');
            $table->string('url_foto_selfie');
            $table->enum('status_verifikasi', ['Belum Diverifikasi', 'Ditolak', 'Terverifikasi'])->default('Belum Diverifikasi');
            $table->enum('status_setujui', ['pending', 'Disetujui', 'Ditolak'])->default('pending');
            $table->timestamps();            
    
            // Definisi Foreign Key
            $table->foreign('usia_id')->references('id')->on('usia'); // FK
            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamin'); // FK
            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaan'); // FK
            $table->foreign('kategori_informasi_id')->references('id')->on('kategori_informasi'); // FK
            $table->foreign('pilihan_pertanian_id')->references('id')->on('pilihan_pertanian'); // FK
            $table->foreign('jenis_pengunjung_id')->references('id')->on('jenis_pengunjung'); // FK
            $table->foreign('pendidikan_id')->references('id')->on('pendidikan'); // FK

            // $table->bigInteger('kategori_kunjungan_id')->unsigned(); // FK
            // $table->string('nama');
            // $table->string('email');
            // $table->bigInteger('alamat_id')->unsigned(); // FK
            // $table->bigInteger('jenis_pengunjung_id')->unsigned(); // FK
            // $table->bigInteger('hari_kunjungan_id')->unsigned(); // FK
            // $table->bigInteger('waktu_kunjungan_id')->unsigned(); // FK
            // $table->timestamps();

            // $table->foreign('kategori_kunjungan_id')->references('id')->on('kategori_kunjungan'); // FK
            // $table->foreign('alamat_id')->references('id')->on('alamat'); // FK
            // $table->foreign('jenis_pengunjung_id')->references('id')->on('jenis_pengunjung'); // FK
            // $table->foreign('hari_kunjungan_id')->references('id')->on('hari_kunjungan'); // FK
            // $table->foreign('waktu_kunjungan_id')->references('id')->on('waktu_kunjungan'); // FK
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
