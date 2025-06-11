<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Perawat;
use App\Models\Pasien;
use App\Models\StatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
    public function show($no_registrasi)
    {
        try {
            Log::info('Fetching examination data for registration number:', ['no_registrasi' => $no_registrasi]);
            
            // Check if patient exists
            $pasien = Pasien::where('no_reg', $no_registrasi)->first();
            Log::info('Patient data:', ['exists' => !is_null($pasien), 'data' => $pasien]);
            
            // Get raw pemeriksaan data
            $rawPemeriksaan = DB::table('pemeriksaan')->where('no_registrasi', $no_registrasi)->first();
            Log::info('Raw pemeriksaan data:', ['exists' => !is_null($rawPemeriksaan), 'data' => $rawPemeriksaan]);
            
            $pemeriksaan = Pemeriksaan::with('pasien')
                ->where('no_registrasi', $no_registrasi)
                ->first();

            Log::info('Query result with relation:', ['pemeriksaan' => $pemeriksaan]);

            if (!$pemeriksaan) {
                Log::warning('No examination data found for registration number:', ['no_registrasi' => $no_registrasi]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pemeriksaan tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $pemeriksaan
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting examination data: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data pemeriksaan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'no_registrasi' => 'required|integer|exists:pasien,no_reg',
                'id_perawat' => 'required|exists:perawat,id_perawat',
                'id_dokter' => 'required|exists:dokter,id_dokter',
                'rm' => 'nullable|integer',
                'suhu' => 'required|integer|between:350,450',
                'tensi' => [
                    'required',
                    'string',
                    'max:10',
                    'regex:/^\d+\/\d+$/'
                ],
                'tinggi_badan' => 'required|integer|between:30,300',
                'berat_badan' => 'required|integer|between:1,500',
                'keluhan' => 'required|string',
                'diagnosa' => 'nullable|string|max:50',
                'tindakan' => 'nullable|string|max:50'
            ], [
                'no_registrasi.required' => 'Nomor registrasi wajib diisi',
                'no_registrasi.integer' => 'Nomor registrasi harus berupa angka',
                'no_registrasi.exists' => 'Nomor registrasi tidak ditemukan di data pasien',
                'id_perawat.required' => 'ID perawat wajib diisi',
                'id_perawat.exists' => 'ID perawat tidak valid',
                'id_dokter.required' => 'ID dokter wajib diisi',
                'id_dokter.exists' => 'ID dokter tidak valid',
                'rm.integer' => 'RM harus berupa angka',
                'suhu.required' => 'Suhu wajib diisi',
                'suhu.integer' => 'Suhu harus berupa angka',
                'suhu.between' => 'Suhu harus antara 35-45°C',
                'tensi.required' => 'Tensi wajib diisi',
                'tensi.max' => 'Tensi maksimal 10 karakter',
                'tensi.regex' => 'Format tensi tidak valid (contoh: 120/80)',
                'tinggi_badan.required' => 'Tinggi badan wajib diisi',
                'tinggi_badan.integer' => 'Tinggi badan harus berupa angka',
                'tinggi_badan.between' => 'Tinggi badan harus antara 30-300 cm',
                'berat_badan.required' => 'Berat badan wajib diisi',
                'berat_badan.integer' => 'Berat badan harus berupa angka',
                'berat_badan.between' => 'Berat badan harus antara 1-500 kg',
                'keluhan.required' => 'Keluhan wajib diisi',
                'diagnosa.max' => 'Diagnosa maksimal 50 karakter',
                'tindakan.max' => 'Tindakan maksimal 50 karakter'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Pastikan id_perawat sesuai dengan user yang login
            $user = Auth::user();
            $perawat = Perawat::where('id_user', $user->id_user)->first();
            
            if (!$perawat || $perawat->id_perawat != $request->id_perawat) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'ID perawat tidak sesuai dengan user yang login'
                ], 403);
            }

            // Konversi data sesuai format database
            $data = $request->only([
                'no_registrasi',
                'id_dokter',
                'id_perawat',
                'rm',
                'suhu',
                'tensi',
                'tinggi_badan',
                'berat_badan',
                'keluhan',
                'diagnosa',
                'tindakan'
            ]);

            Log::info('Data yang akan disimpan:', $data);

            // Gunakan transaction untuk memastikan konsistensi data
            $result = DB::transaction(function () use ($data, $perawat, $request) {
                // Simpan data pemeriksaan
                $pemeriksaan = Pemeriksaan::create($data);

                // Tambah history status
                StatusHistory::addStatus(
                    $request->no_registrasi,
                    'Diperiksa',
                    'perawat',
                    $perawat->id_perawat,
                    'Status diubah melalui pemeriksaan'
                );

                return $pemeriksaan;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data pemeriksaan berhasil disimpan',
                'data' => $result
            ], 201);

        } catch (\Exception $e) {
            Log::error('Pemeriksaan save error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data pemeriksaan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateDiagnosa(Request $request, $no_registrasi)
    {
        try {
            // Set encoding for logging
            mb_internal_encoding('UTF-8');
            
            Log::info('Starting diagnosa update for no_registrasi: ' . $no_registrasi);
            Log::info('Request data: ' . json_encode($request->all(), JSON_UNESCAPED_UNICODE));

            $validator = Validator::make($request->all(), [
                'diagnosa' => 'required|string|max:50',
                'tindakan' => 'required|string|max:50'
            ], [
                'diagnosa.required' => 'Diagnosa wajib diisi',
                'diagnosa.max' => 'Diagnosa maksimal 50 karakter',
                'tindakan.required' => 'Tindakan wajib diisi',
                'tindakan.max' => 'Tindakan maksimal 50 karakter'
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed: ' . json_encode($validator->errors()->toArray(), JSON_UNESCAPED_UNICODE));
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Find and update the pemeriksaan record
            $pemeriksaan = Pemeriksaan::where('no_registrasi', $no_registrasi)->first();
            Log::info('Found pemeriksaan record: ' . ($pemeriksaan ? 'yes' : 'no'));
            
            if (!$pemeriksaan) {
                Log::warning('Pemeriksaan not found for no_registrasi: ' . $no_registrasi);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pemeriksaan tidak ditemukan'
                ], 404);
            }

            // Log current values before update
            Log::info('Current pemeriksaan data: ' . json_encode($pemeriksaan->toArray(), JSON_UNESCAPED_UNICODE));

            // Generate RM number using a shorter timestamp format
            $timestamp = now()->format('ymd');
            $random = rand(1000, 9999);
            $rm = intval($timestamp . $random);
            Log::info('Generated RM number: ' . $rm);

            try {
                DB::beginTransaction();

                // Update only diagnosa, tindakan, and rm
                $pemeriksaan->diagnosa = $request->diagnosa;
                $pemeriksaan->tindakan = $request->tindakan;
                $pemeriksaan->rm = $rm;

                // Log values that will be saved
                Log::info('Values to be saved: ' . json_encode([
                    'diagnosa' => $request->diagnosa,
                    'tindakan' => $request->tindakan,
                    'rm' => $rm
                ], JSON_UNESCAPED_UNICODE));

                $pemeriksaan->save();
                Log::info('Pemeriksaan record updated successfully');

                // Get user data for status update
                $user = Auth::user();
                $dokter = \App\Models\Dokter::where('id_user', $user->id_user)->first();
                Log::info('Found dokter: ' . ($dokter ? 'yes' : 'no'));

                if ($dokter) {
                    // Update status to "Selesai"
                    StatusHistory::addStatus(
                        $no_registrasi,
                        'Selesai',
                        'dokter',
                        $dokter->id_dokter,
                        'Diagnosa selesai'
                    );
                    Log::info('Status history updated');
                } else {
                    Log::warning('Dokter not found for user_id: ' . $user->id_user);
                }

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Diagnosa berhasil disimpan',
                    'data' => $pemeriksaan
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error in transaction: ' . $e->getMessage());
                Log::error('Stack trace: ' . $e->getTraceAsString());
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Error updating diagnosis: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Additional context: ' . json_encode([
                'no_registrasi' => $no_registrasi,
                'request_data' => $request->all()
            ], JSON_UNESCAPED_UNICODE));
            
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan diagnosa',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
