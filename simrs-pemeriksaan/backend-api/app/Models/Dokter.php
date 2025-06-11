<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';  // sesuaikan jika berbeda
    protected $primaryKey = 'id_dokter';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_dokter',
        'no_hp_dokter',
        'spesialis'
    ];

    // Relasi balik ke Jadwal (optional)
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_dokter', 'id_dokter');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
    }
}
