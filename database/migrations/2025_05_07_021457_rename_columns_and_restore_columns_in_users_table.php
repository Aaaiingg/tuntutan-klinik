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
        Schema::table('users', function (Blueprint $table) {
             // Rename column kepada asal
             $table->renameColumn('USER_name', 'name');
             $table->renameColumn('USER_email', 'email');
             $table->renameColumn('USER_password', 'password');
             $table->renameColumn('USER_role', 'role');
 
             // Tambah semula column yang dipadamkan (jika perlu)
             $table->timestamp('email_verified_at')->nullable();
             $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Undo changes made in the 'up' function
            $table->dropColumn('email_verified_at');
            $table->dropColumn('remember_token');

            
        });
    }
};
