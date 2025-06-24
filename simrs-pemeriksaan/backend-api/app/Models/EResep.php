<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eresep extends Model
{
    //
    protected $table = 'e_resep';
    protected $fillable = [
        'no_registrasi',
    ];
    public $timestamps = false;
    public function details()
    {
        return $this->hasMany(EResepDetail::class, 'id_resep', 'id_resep');
    }
}
