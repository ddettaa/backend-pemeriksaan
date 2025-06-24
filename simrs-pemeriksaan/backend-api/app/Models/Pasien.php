<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    /**
     * Nama tabel (sesuaikan jika berbeda)
     * Jika tabel lokal menggunakan nama lain, ubah di sini.
     */
    protected $table = 'pendaftaran';

    /**
     * Primary key di tabel
     */
    protected $primaryKey = 'no_registrasi';

    /**
     * Tidak menggunakan auto-increment pada primary key
     */
    public $incrementing = false;

    /**
     * Tipe primary key
     */
    protected $keyType = 'int';

    /**
     * Nonaktifkan timestamps (created_at, updated_at)
     * Jika tabel memiliki kolom timestamps, atur ke true.
     */
    public $timestamps = false;

    /**
     * Field yang dapat diisi massal
     */
    protected $fillable = [
        'no_registrasi',
        'rm',
        'nama_pasien',
        'nik_pasien',
        'nama_poli',
        'nama_dokter',
        'status_raw',
        'status',
        'no_antrian',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'no_registrasi' => 'integer',
        'rm'             => 'integer',
        'nik_pasien'     => 'integer',
        'status_raw'     => 'integer',
        'no_antrian'     => 'integer',
    ];
}
