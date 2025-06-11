<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Drop foreign key from e_resep
        Schema::table('e_resep', function (Blueprint $table) {
            $table->dropForeign('e_resep_ibfk_1');
        });

        // 2. Fix pemeriksaan table
        Schema::table('pemeriksaan', function (Blueprint $table) {
            // Drop auto increment from no_registrasi
            DB::statement('ALTER TABLE pemeriksaan MODIFY no_registrasi smallint NOT NULL');
            
            // Add foreign key constraint
            $table->foreign('no_registrasi')
                  ->references('no_reg')
                  ->on('pasien')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // 3. Add back foreign key to e_resep
        Schema::table('e_resep', function (Blueprint $table) {
            $table->foreign('no_registrasi')
                  ->references('no_registrasi')
                  ->on('pemeriksaan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        // 1. Drop foreign key from e_resep
        Schema::table('e_resep', function (Blueprint $table) {
            $table->dropForeign(['no_registrasi']);
        });

        // 2. Revert pemeriksaan table
        Schema::table('pemeriksaan', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['no_registrasi']);
            
            // Add back auto increment
            DB::statement('ALTER TABLE pemeriksaan MODIFY no_registrasi smallint NOT NULL AUTO_INCREMENT');
        });

        // 3. Add back original foreign key to e_resep
        Schema::table('e_resep', function (Blueprint $table) {
            $table->foreign('no_registrasi')
                  ->references('no_registrasi')
                  ->on('pemeriksaan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade')
                  ->name('e_resep_ibfk_1');
        });
    }
}; 