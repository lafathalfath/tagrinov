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
            $table->string('deskripsi')->nullable();
            $table->string('varietas')->nullable();
            $table->string('potensi_hasil')->nullable();
            $table->string('keunggulan')->nullable();
            $table->string('manfaat')->nullable();
            $table->string('agroekosistem')->nullable();
            $table->string('kandungan')->nullable();
            $table->string('syarat_tumbuh')->nullable();
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
