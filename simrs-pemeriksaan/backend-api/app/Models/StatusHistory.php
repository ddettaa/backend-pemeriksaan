<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $table = 'status_histories';

    protected $fillable = [
        'no_registrasi',
        'status',
        'keterangan',
        'changed_by_type',
        'changed_by_id'
    ];

    // Relasi ke pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'no_registrasi', 'no_reg');
    }

    // Relasi polymorphic untuk yang mengubah status
    public function changedBy()
    {
        return $this->morphTo('changed_by');
    }

    // Method untuk mendapatkan status terakhir pasien
    public static function getCurrentStatus($noReg)
    {
        return self::where('no_registrasi', $noReg)
                   ->latest()
                   ->first();
    }

    // Method untuk menambah history status baru
    public static function addStatus($noReg, $status, $changedByType, $changedById, $keterangan = null)
    {
        return self::create([
            'no_registrasi' => $noReg,
            'status' => $status,
            'keterangan' => $keterangan,
            'changed_by_type' => $changedByType,
            'changed_by_id' => $changedById
        ]);
    }
} 