<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('claims', function (Blueprint $table) {
        $table->date('tarikh_resit')->nullable()->after('jumlah_resit'); // Letak selepas jumlah_resit (ubah ikut keperluan)
    });
}

public function down()
{
    Schema::table('claims', function (Blueprint $table) {
        $table->dropColumn('tarikh_resit');
    });
}

};
