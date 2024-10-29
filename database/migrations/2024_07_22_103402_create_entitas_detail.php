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
        Schema::create('entitas_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('entitas_id')->unsigned();
            $table->text('deskripsi')->nullable();
            $table->text('varietas')->nullable();
            $table->text('potensi_hasil')->nullable();
            $table->text('keunggulan')->nullable();
            $table->text('manfaat')->nullable();
            $table->text('agroekosistem')->nullable();
            $table->text('kandungan')->nullable();
            $table->text('syarat_tumbuh')->nullable();
            $table->string('judul_buku')->nullable();
            $table->string('url_buku')->nullable();
            $table->timestamps();

            $table->foreign('entitas_id')->references('id')->on('entitas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entitas_detail');
    }
};
