<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;  // Sesuaikan dengan model jadwal doktermu
use Illuminate\Http\Request;

/**
 * @OA\Info(title="SIMRS API", version="1.0")
 */
class JadwalDokterController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/jadwal-dokter",
     *     summary="Ambil semua data jadwal dokter",
     *     @OA\Response(response=200, description="Daftar jadwal dokter")
     * )
     */
    /**
     * Ambil semua data jadwal dokter.
     *
     * @group Jadwal Dokter
     * @response 200 [
     *     {
     *         "id": 1,
     *         "nama_dokter": "Dr. Smith",
     *         "hari": "Senin",
     *         "jam_mulai": "08:00",
     *         "jam_akhir": "16:00"
     *     }
     * ]
     */
    public function index()
    {
        // Ambil semua data jadwal dokter dari DB
        $jadwal = JadwalDokter::all();

        // Kembalikan data dalam format JSON
        return response()->json($jadwal);
    }
}
