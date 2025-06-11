<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('status_histories', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi');
            $table->string('status');
            $table->string('keterangan')->nullable();
            $table->string('changed_by_type'); // 'dokter', 'perawat', 'sistem'
            $table->unsignedBigInteger('changed_by_id');
            $table->timestamps();

            $table->foreign('no_registrasi')
                  ->references('no_reg')
                  ->on('pasien')
                  ->onDelete('cascade');

            $table->index(['no_registrasi', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('status_histories');
    }
}; 