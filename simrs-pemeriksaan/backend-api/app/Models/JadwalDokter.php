<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokter'; // Nama tabel di database

    // Jika tabel tidak pakai timestamps:
    public $timestamps = false;

    // Tentukan kolom yang bisa diisi massal (optional)
    protected $fillable = [
        'nama_dokter', 'spesialis', 'hari', 'jam_mulai', 'jam_selesai'
    ];
}
