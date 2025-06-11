<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index()
    {
        // Ambil data jadwal beserta relasi perawat
        $jadwals = Jadwal::with('perawat')->get()->map(function ($jadwal) {
            return [
                'nama_perawat' => $jadwal->perawat->nama_perawat, // asumsi kolom nama_perawat di tabel perawat
                'hari' => $jadwal->hari,
                'jam' => $jadwal->jam_mulai . ' - ' . $jadwal->jam_akhir,
            ];
        });

        return response()->json($jadwals);
    }
    public function jadwalDokter()
{
    $jadwalDokter = Jadwal::with('dokter')
        ->get()
        ->map(function ($item) {
            return [
                'id_jadwal' => $item->id_jadwal,
                'nama_dokter' => $item->dokter->nama_dokter ?? null,
                'hari' => $item->hari,
                'jam_mulai' => $item->jam_mulai,
                'jam_akhir' => $item->jam_akhir,
            ];
        });

    return response()->json($jadwalDokter);
}

}
