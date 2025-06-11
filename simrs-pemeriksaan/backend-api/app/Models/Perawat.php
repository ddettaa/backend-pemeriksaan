<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    protected $table = 'perawat'; // sesuaikan nama tabel
    protected $primaryKey = 'id_perawat'; // sesuaikan primary key

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_perawat',
        'no_hp_perawat',
        // kolom lain di tabel perawat jika ada
    ];

    // Kalau mau bisa bikin relasi balik ke Jadwal (optional)
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_perawat', 'id_perawat');
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
