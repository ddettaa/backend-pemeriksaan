<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal'; // sesuaikan jika tabelmu bukan 'jadwal'
    protected $primaryKey = 'id_jadwal'; // jika primary key bukan 'id'

    // Jika tidak ingin menggunakan timestamp (created_at, updated_at)
    public $timestamps = false;

    // Daftarkan kolom yang bisa diisi massal (optional tapi bagus)
    protected $fillable = [
        'id_perawat', 'id_dokter', 'hari', 'jam_mulai', 'jam_akhir'
    ];

    // Relasi ke Perawat
    public function perawat()
    {
        return $this->belongsTo(Perawat::class, 'id_perawat', 'id_perawat');
        // format: belongsTo(ModelTarget::class, foreign_key_di_tabel_jadwal, primary_key_di_tabel_perawat)
    }
    public function dokter()
{
    return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
}
}
