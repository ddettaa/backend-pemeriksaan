<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'no_reg';
    public $incrementing = false;

    protected $fillable = [
        'no_reg',
        'nama_pasien',
        'alamat',
        'no_telp',
        'jenis_kelamin',
        'tanggal_lahir'
    ];

    // Relasi ke status history
    public function statusHistories()
    {
        return $this->hasMany(StatusHistory::class, 'no_registrasi', 'no_reg');
    }

    // Method untuk mendapatkan status terakhir
    public function getCurrentStatus()
    {
        try {
            Log::info('Getting current status for patient:', ['no_reg' => $this->no_reg]);
            
            $latestStatus = $this->statusHistories()
                                ->latest()
                                ->first();
            
            Log::info('Latest status found:', [
                'status' => $latestStatus ? $latestStatus->status : 'No status found'
            ]);
            
            return $latestStatus?->status ?? 'Menunggu';
        } catch (\Exception $e) {
            Log::error('Error getting current status:', [
                'no_reg' => $this->no_reg,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 'Menunggu';
        }
    }

    // Method untuk menambah status baru
    public function addStatus($status, $changedByType, $changedById, $keterangan = null)
    {
        return StatusHistory::addStatus(
            $this->no_reg,
            $status,
            $changedByType,
            $changedById,
            $keterangan
        );
    }

    // Method untuk mendapatkan history status
    public function getStatusHistory()
    {
        return $this->statusHistories()
                    ->with('changedBy')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'no_registrasi', 'no_reg');
    }

    /* Temporarily comment out until models are created
    public function resep()
    {
        return $this->hasMany(Resep::class, 'no_registrasi', 'no_reg');
    }
    */
} 