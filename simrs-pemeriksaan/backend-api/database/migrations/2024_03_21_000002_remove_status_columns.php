<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Hapus kolom status dari tabel pasien
        Schema::table('pasien', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Hapus kolom status dari tabel pemeriksaan menggunakan raw SQL
        DB::statement('ALTER TABLE pemeriksaan DROP COLUMN status');
    }

    public function down()
    {
        // Kembalikan kolom status ke tabel pasien
        Schema::table('pasien', function (Blueprint $table) {
            $table->string('status')->nullable();
        });

        // Kembalikan kolom status ke tabel pemeriksaan menggunakan raw SQL
        DB::statement('ALTER TABLE pemeriksaan ADD COLUMN status ENUM("Menunggu", "Diperiksa", "Selesai Diperiksa", "Sudah Bayar", "Sudah ambil obat") NOT NULL DEFAULT "Diperiksa"');
    }
}; 