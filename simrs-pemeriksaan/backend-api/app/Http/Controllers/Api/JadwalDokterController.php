<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;  // Sesuaikan dengan model jadwal doktermu
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function index()
    {
        // Ambil semua data jadwal dokter dari DB
        $jadwal = JadwalDokter::all();

        // Kembalikan data dalam format JSON
        return response()->json($jadwal);
    }
}
