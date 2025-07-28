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
        Schema::table('staff', function (Blueprint $table) {
           $table->unsignedBigInteger('dept_id')->nullable()->after('staff_kelayakan');
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif')->after('dept_id');

            // Tambah foreign key (optional tapi disarankan)
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign(['dept_id']);
            $table->dropColumn(['dept_id', 'status']);
        });
    }
};
