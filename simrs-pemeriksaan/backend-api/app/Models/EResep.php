<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EResep extends Model
{
    protected $table = 'e_resep';
    protected $primaryKey = 'id_resep'; // <-- tambahkan ini!
    public $incrementing = true;
    protected $fillable = ['no_registrasi'];
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(EResepDetail::class, 'id_resep', 'id_resep');
    }

}
