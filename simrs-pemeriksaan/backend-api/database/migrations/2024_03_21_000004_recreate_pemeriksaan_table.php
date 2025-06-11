<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Drop foreign key from e_resep if exists
        if (Schema::hasTable('e_resep')) {
            // Get the actual foreign key name from the database
            $foreignKeyName = DB::select("
                SELECT CONSTRAINT_NAME
                FROM information_schema.KEY_COLUMN_USAGE
                WHERE TABLE_NAME = 'e_resep'
                AND COLUMN_NAME = 'no_registrasi'
                AND CONSTRAINT_SCHEMA = DATABASE()
                AND REFERENCED_TABLE_NAME = 'pemeriksaan'
            ");

            if (!empty($foreignKeyName)) {
                Schema::table('e_resep', function (Blueprint $table) use ($foreignKeyName) {
                    $table->dropForeign($foreignKeyName[0]->CONSTRAINT_NAME);
                });
            }
        }

        // 2. Drop existing pemeriksaan table
        Schema::dropIfExists('pemeriksaan');

        // 3. Create new pemeriksaan table with correct structure
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->smallInteger('no_registrasi');
            $table->smallInteger('id_dokter')->nullable();
            $table->smallInteger('id_perawat');
            $table->integer('rm')->nullable();
            $table->smallInteger('suhu');
            $table->string('tensi', 10);
            $table->smallInteger('tinggi_badan');
            $table->smallInteger('berat_badan');
            $table->text('keluhan');
            $table->string('diagnosa', 50)->nullable();
            $table->string('tindakan', 50)->nullable();
            
            // Set primary key
            $table->primary('no_registrasi');

            // Add foreign key constraints
            $table->foreign('no_registrasi')
                  ->references('no_reg')
                  ->on('pasien')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('id_dokter')
                  ->references('id_dokter')
                  ->on('dokter')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('id_perawat')
                  ->references('id_perawat')
                  ->on('perawat')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // 4. Add back foreign key to e_resep if exists
        if (Schema::hasTable('e_resep')) {
            Schema::table('e_resep', function (Blueprint $table) {
                $table->foreign('no_registrasi')
                      ->references('no_registrasi')
                      ->on('pemeriksaan')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
            });
        }
    }

    public function down()
    {
        // 1. Drop foreign key from e_resep if exists
        if (Schema::hasTable('e_resep')) {
            Schema::table('e_resep', function (Blueprint $table) {
                $table->dropForeign(['no_registrasi']);
            });
        }

        // 2. Drop pemeriksaan table
        Schema::dropIfExists('pemeriksaan');

        // 3. Recreate original pemeriksaan table
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->smallInteger('no_registrasi')->autoIncrement();
            $table->smallInteger('id_dokter');
            $table->smallInteger('id_perawat');
            $table->integer('rm')->nullable();
            $table->smallInteger('suhu');
            $table->string('tensi', 10);
            $table->smallInteger('tinggi_badan');
            $table->smallInteger('berat_badan');
            $table->text('keluhan');
            $table->string('diagnosa', 50)->nullable();
            $table->string('tindakan', 50)->nullable();

            $table->foreign('id_dokter')
                  ->references('id_dokter')
                  ->on('dokter')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('id_perawat')
                  ->references('id_perawat')
                  ->on('perawat')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        // 4. Add back original foreign key to e_resep if exists
        if (Schema::hasTable('e_resep')) {
            Schema::table('e_resep', function (Blueprint $table) {
                $table->foreign('no_registrasi')
                      ->references('no_registrasi')
                      ->on('pemeriksaan')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
            });
        }
    }
}; 