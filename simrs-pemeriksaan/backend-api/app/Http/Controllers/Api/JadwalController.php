<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;

/**
 * @OA\Info(title="SIMRS API", version="1.0")
 */
class JadwalController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/jadwal",
     *     summary="Ambil daftar jadwal beserta nama perawat",
     *     @OA\Response(response=200, description="Daftar jadwal")
     * )
     */
    /**
     * Ambil daftar jadwal beserta nama perawat.
     *
     * @group Jadwal
     * @response 200 [
     *     {
     *         "nama_perawat": "John Doe",
     *         "hari": "Senin",
     *         "jam": "08:00 - 16:00"
     *     }
     * ]
     */
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
    /**
     * @OA\Get(
     *     path="/api/jadwal/dokter",
     *     summary="Ambil daftar jadwal dokter beserta nama dokter",
     *     @OA\Response(response=200, description="Daftar jadwal dokter")
     * )
     */
    /**
     * Ambil daftar jadwal dokter beserta nama dokter.
     *
     * @group Jadwal
     * @response 200 [
     *     {
     *         "id_jadwal": 1,
     *         "nama_dokter": "Dr. Smith",
     *         "hari": "Senin",
     *         "jam_mulai": "08:00",
     *         "jam_akhir": "16:00"
     *     }
     * ]
     */
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
