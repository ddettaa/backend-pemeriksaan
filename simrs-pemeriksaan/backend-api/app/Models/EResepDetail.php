<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EResepDetail extends Model
{
    protected $table = 'detail_e_resep';
    protected $fillable = ['id_resep', 'id_obat', 'jumlah', 'aturan_pakai'];
    public $timestamps = false;

    public function resep()
    {
        return $this->belongsTo(EResep::class, 'id_resep', 'id_resep');
    }
}
