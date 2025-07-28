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
            $table->string('sahkan_ketua_jabatan')->nullable()->change();
        $table->string('semak_ptjkp')->nullable()->change();
        $table->string('sahkan_kptjkp')->nullable()->change();
        $table->string('lulus_pkjkp')->nullable()->change();
        $table->string('semak_ptkw')->nullable()->change();
        $table->string('sahkan_kptkw')->nullable()->change();
        $table->string('lulus_pkkw')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->boolean('sahkan_ketua_jabatan')->default(false)->change();
            $table->boolean('semak_ptjkp')->default(false)->change();
            $table->boolean('sahkan_kptjkp')->default(false)->change();
            $table->boolean('lulus_pkjkp')->default(false)->change();
            $table->boolean('semak_ptkw')->default(false)->change();
            $table->boolean('sahkan_kptkw')->default(false)->change();
            $table->boolean('lulus_pkkw')->default(false)->change();
        });
    }
};
