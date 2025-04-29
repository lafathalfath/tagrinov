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
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->unsignedBigInteger('rejectverify_by')->nullable()->after('verified_by');
            $table->timestamp('rejectverify_at')->nullable()->after('rejectverify_by');

            $table->unsignedBigInteger('rejectapprove_by')->nullable()->after('approved_by');
            $table->timestamp('rejectapprove_at')->nullable()->after('rejectapprove_by');

            // Opsional: relasi ke tabel users jika pakai
            $table->foreign('rejectverify_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('rejectapprove_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->dropForeign(['rejectverify_by']);
            $table->dropForeign(['rejectapprove_by']);

            $table->dropColumn([
                'rejectverify_by',
                'rejectverify_at',
                'rejectapprove_by',
                'rejectapprove_at',
            ]);
        });
    }
};
