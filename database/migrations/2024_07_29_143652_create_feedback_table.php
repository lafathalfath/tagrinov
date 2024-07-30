<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->date('tanggal');
            $table->tinyInteger('rating');
            $table->text('pesan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
