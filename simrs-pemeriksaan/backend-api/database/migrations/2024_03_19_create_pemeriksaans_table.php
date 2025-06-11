<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
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
            $table->enum('status', ['Menunggu', 'Diperiksa', 'Selesai Diperiksa', 'Sudah Bayar', 'Sudah ambil obat'])->default('Diperiksa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemeriksaans');
    }
}; 