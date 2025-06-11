<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    public function up()
    {
        try {
            // 1. Backup existing data if tables exist
            $existingData = Schema::hasTable('pemeriksaan') ? DB::table('pemeriksaan')->get() : collect();
            $existingEResepData = Schema::hasTable('e_resep') ? DB::table('e_resep')->get() : collect();
            $existingDetailEResepData = Schema::hasTable('detail_e_resep') ? DB::table('detail_e_resep')->get() : collect();
            
            // 2. Drop tables if they exist
            Schema::dropIfExists('detail_e_resep');
            Schema::dropIfExists('e_resep');
            Schema::dropIfExists('pemeriksaan');
            
            // 3. Create pemeriksaan table with correct structure
            Schema::create('pemeriksaan', function (Blueprint $table) {
                $table->smallInteger('no_registrasi');
                $table->smallInteger('id_dokter')->nullable();
                $table->smallInteger('id_perawat');
                $table->string('rm', 20)->nullable();
                $table->smallInteger('suhu');
                $table->string('tensi', 10);
                $table->smallInteger('tinggi_badan');
                $table->smallInteger('berat_badan');
                $table->text('keluhan');
                $table->string('diagnosa', 50)->nullable();
                $table->string('tindakan', 50)->nullable();

                $table->primary('no_registrasi');
                
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

            // 4. Restore pemeriksaan data if exists
            if ($existingData->count() > 0) {
                foreach ($existingData as $record) {
                    // Convert rm to string if it exists
                    if (isset($record->rm)) {
                        $record->rm = (string)$record->rm;
                    }
                    DB::table('pemeriksaan')->insert((array) $record);
                }
            }

            // 5. Create e_resep table
            Schema::create('e_resep', function (Blueprint $table) {
                $table->smallInteger('id_resep')->autoIncrement();
                $table->smallInteger('no_registrasi');
                
                $table->foreign('no_registrasi')
                      ->references('no_registrasi')
                      ->on('pemeriksaan')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
            });

            // 6. Restore e_resep data if exists
            if ($existingEResepData->count() > 0) {
                foreach ($existingEResepData as $record) {
                    DB::table('e_resep')->insert((array) $record);
                }
            }

            // 7. Create detail_e_resep table
            Schema::create('detail_e_resep', function (Blueprint $table) {
                $table->smallInteger('id_detail_resep')->autoIncrement();
                $table->smallInteger('id_resep');
                $table->string('nama_obat', 50);
                $table->string('dosis', 50);
                $table->string('jumlah', 50);
                $table->string('satuan', 50);
                $table->string('keterangan', 100)->nullable();
                
                $table->foreign('id_resep')
                      ->references('id_resep')
                      ->on('e_resep')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
            });

            // 8. Restore detail_e_resep data if exists
            if ($existingDetailEResepData->count() > 0) {
                foreach ($existingDetailEResepData as $record) {
                    DB::table('detail_e_resep')->insert((array) $record);
                }
            }

        } catch (\Exception $e) {
            // Log error
            Log::error('Migration failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }

    public function down()
    {
        // Since this is a fix, we don't need to do anything in down()
        // as reverting would mean going back to the broken state
    }
}; 