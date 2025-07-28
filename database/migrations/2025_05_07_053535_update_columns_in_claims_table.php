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
             // ✅ Tukar nama kolum
             //$table->renameColumn('nama_klinik', 'nama_kemudahan'); // contoh

             // ✅ Buang kolum yang tak perlu
             $table->dropColumn(['jumlah_semasa']);
             $table->dropColumn(['kelayakan']);
             $table->dropColumn(['jumlah_diambil']);
             $table->dropColumn(['baki']); // boleh senaraikan banyak dalam array
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
