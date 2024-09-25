<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusColumnInFeedbackTable extends Migration
{
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->enum('status', ['pending', 'Ditolak', 'Disetujui'])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->string('status')->change(); // Rollback to varchar if needed
        });
    }
};
