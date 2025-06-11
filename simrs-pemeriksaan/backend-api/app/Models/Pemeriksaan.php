<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';
    protected $primaryKey = 'no_registrasi';
    public $incrementing = false;
    protected $keyType = 'integer';
    public $timestamps = false;

    protected $fillable = [
        'no_registrasi',
        'id_dokter',
        'id_perawat',
        'rm',
        'suhu',
        'tensi',
        'tinggi_badan',
        'berat_badan',
        'diagnosa',
        'tindakan',
        'keluhan'
    ];

    protected $casts = [
        'no_registrasi' => 'integer',
        'id_dokter' => 'integer',
        'id_perawat' => 'integer',
        'rm' => 'integer',
        'suhu' => 'integer',
        'tinggi_badan' => 'integer',
        'berat_badan' => 'integer'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    public function perawat()
    {
        return $this->belongsTo(Perawat::class, 'id_perawat', 'id_perawat');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_registrasi', 'no_reg');
    }
}
