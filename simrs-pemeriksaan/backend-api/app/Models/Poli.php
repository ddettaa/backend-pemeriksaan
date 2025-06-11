<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $primaryKey = 'id_poli';
    public $timestamps = false;

    protected $fillable = [
        'id_poli',
        'id_perawat',
        'id_dokter',
        'nama_poli'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    public function perawat()
    {
        return $this->belongsTo(Perawat::class, 'id_perawat', 'id_perawat');
    }
} 