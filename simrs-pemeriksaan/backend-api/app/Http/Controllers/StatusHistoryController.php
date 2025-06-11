<?php

namespace App\Http\Controllers;

use App\Models\StatusHistory;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StatusHistoryController extends Controller
{
    // Mendapatkan status terkini pasien
    public function getCurrentStatus($noReg)
    {
        try {
            $pasien = Pasien::findOrFail($noReg);
            $currentStatus = $pasien->getCurrentStatus();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'no_registrasi' => $noReg,
                    'current_status' => $currentStatus
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan status pasien',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mendapatkan history status pasien
    public function getStatusHistory($noReg)
    {
        try {
            $pasien = Pasien::findOrFail($noReg);
            $statusHistory = $pasien->getStatusHistory();

            return response()->json([
                'status' => 'success',
                'data' => $statusHistory
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan history status pasien',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Menambah status baru
    public function addStatus(Request $request)
    {
        try {
            Log::info('Received status update request:', $request->all());
            
            // Validasi input dari frontend
            $request->validate([
                'no_registrasi' => 'required|exists:pasien,no_reg',
                'status' => 'required|string',
                'keterangan' => 'nullable|string',
                'role' => 'required|in:dokter,perawat,sistem',
                'id_petugas' => 'required|integer'
            ]);

            // Map role ke changed_by_type
            $changed_by_type = $request->role;
            $changed_by_id = $request->id_petugas;

            $statusHistory = StatusHistory::addStatus(
                $request->no_registrasi,
                $request->status,
                $changed_by_type,
                $changed_by_id,
                $request->keterangan
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Status berhasil ditambahkan',
                'data' => $statusHistory
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error adding status: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 