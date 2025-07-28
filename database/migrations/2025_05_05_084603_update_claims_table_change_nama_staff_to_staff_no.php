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
        Schema::table('claims', function (Blueprint $table) {
            $table->dropColumn('nama_staff'); // Buang kolum lama
            $table->string('staff_no')->nullable();// Ganti dengan no siri
            $table->foreign('staff_no')->references('staff_no')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->dropForeign(['staff_no']);
            $table->dropColumn('staff_no');
            $table->string('nama_staff'); // Restore kolum lama jika rollback
        });
    }
};
