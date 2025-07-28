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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // siapa buat tuntutan
            $table->string('nama_staff');
            $table->string('nama_klinik');
            $table->string('no_resit');
            $table->decimal('jumlah_resit', 10, 2);
            $table->decimal('jumlah_semasa', 10, 2);
            $table->decimal('kelayakan', 10, 2);
            $table->decimal('jumlah_diambil', 10, 2);
            $table->decimal('baki', 8, 2);

            $table->enum('bulan', [
                'Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun',
                'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'
            ]);
            
            $table->string('resit_path')->nullable(); // lokasi gambar resit
            $table->string('status')->default('Baharu');
        
            $table->timestamps();
        
            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
