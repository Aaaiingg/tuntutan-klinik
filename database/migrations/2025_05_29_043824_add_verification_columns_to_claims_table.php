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
        $table->boolean('sahkan_ketua_jabatan')->default(false);
        $table->boolean('semak_ptjkp')->default(false);
        $table->boolean('sahkan_kptjkp')->default(false);
        $table->boolean('lulus_pkjkp')->default(false);
        $table->boolean('semak_ptkw')->default(false);
        $table->boolean('sahkan_kptkw')->default(false);
        $table->boolean('lulus_pkkw')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            //
        });
    }
};
