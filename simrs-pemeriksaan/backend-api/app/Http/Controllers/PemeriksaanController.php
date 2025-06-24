<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Perawat;
use App\Models\StatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PemeriksaanController extends Controller
{
    public function index()
    {
        try {
            Log::info('Fetching all examinations');

            // 1. Ambil data dari API eksternal
            $apiResp = Http::get('https://ti054a01.agussbn.my.id/api/pendaftaran');
            if (!$apiResp->successful()) {
                Log::warning('API pendaftaran gagal');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengambil daftar pasien dari API'
                ], 500);
            }

            $pasienList = $apiResp->json('data');
            if (!is_array($pasienList)) {
                Log::error('Format data API tidak sesuai (bukan array)');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Format data dari API tidak valid'
                ], 500);
            }

            $pemeriksaanList = DB::table('pemeriksaan')->get()->keyBy('no_registrasi');

            $combined = [];
            foreach ($pasienList as $pasien) {
                $no = $pasien['no_registrasi'] ?? null;
                $combined[] = [
                    'pasien' => $pasien,
                    'pemeriksaan' => $pemeriksaanList->has($no) ? $pemeriksaanList->get($no) : null
                ];
            }

            return response()->json([
                'status' => 'success',
                'data' => $combined
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching all examinations: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil daftar pemeriksaan'
            ], 500);
        }
    }

    public function show($no_registrasi)
    {
        try {
            Log::info('Fetching examination for: ' . $no_registrasi);

            $apiResp = Http::get("https://ti054a01.agussbn.my.id/api/pendaftaran/{$no_registrasi}");
            if (!$apiResp->successful()) {
                Log::warning('API pendaftaran gagal atau data tidak ditemukan', ['no_registrasi' => $no_registrasi]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pasien tidak ditemukan di API'
                ], 404);
            }

            $pasienData = collect($apiResp->json('data'))->first();

            $pemeriksaan = DB::table('pemeriksaan')->where('no_registrasi', $no_registrasi)->first();
            if (!$pemeriksaan) {
                Log::warning('Data pemeriksaan tidak ditemukan', ['no_registrasi' => $no_registrasi]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pemeriksaan tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'pasien' => $pasienData,
                    'pemeriksaan' => $pemeriksaan
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting examination: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data pemeriksaan'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'no_registrasi' => 'required|integer',
                'id_perawat'    => 'required|exists:perawat,id_perawat',
                'id_dokter'     => 'required|exists:dokter,id_dokter',
                'rm'            => 'nullable|integer',
                'suhu'          => 'required|integer|between:350,450',
                'tensi'         => ['required', 'string', 'regex:/^\d+\/\d+$/'],
                'tinggi_badan'  => 'required|integer|between:30,300',
                'berat_badan'   => 'required|integer|between:1,500',
                'keluhan'       => 'required|string',
                'diagnosa'      => 'nullable|string|max:50',
                'tindakan'      => 'nullable|string|max:50'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // PERBAIKAN: Cek otentikasi user dengan penanganan yang lebih baik
            $user = Auth::user();
            
            // Jika user tidak ditemukan, coba ambil perawat berdasarkan id_perawat dari request
            if (!$user) {
                Log::warning('User tidak ditemukan, menggunakan id_perawat dari request', ['id_perawat' => $request->id_perawat]);
                $perawat = Perawat::where('id_perawat', $request->id_perawat)->first();
                
                if (!$perawat) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'ID perawat tidak ditemukan.'
                    ], 403);
                }
            } else {
                // Jika user ditemukan, cek apakah user adalah perawat
                $perawat = Perawat::where('id_user', $user->id)->first();
                
                if (!$perawat) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'User yang login bukan perawat atau tidak terdaftar di tabel perawat.'
                    ], 403);
                }

                // Validasi bahwa id_perawat dari request sesuai dengan user yang login
                if ($perawat->id_perawat != $request->id_perawat) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'ID perawat dari token tidak sesuai dengan ID perawat di request.'
                    ], 403);
                }
            }

            $data = $request->only([
                'no_registrasi','id_dokter','id_perawat','rm',
                'suhu','tensi','tinggi_badan','berat_badan',
                'keluhan','diagnosa','tindakan'
            ]);

            $pemeriksaan = DB::transaction(function () use ($data, $perawat, $request) {
                $record = Pemeriksaan::create($data);
                StatusHistory::addStatus(
                    $request->no_registrasi,
                    'Diperiksa',
                    'perawat',
                    $perawat->id_perawat,
                    'Status diubah melalui pemeriksaan'
                );
                return $record;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $pemeriksaan
            ], 201);
        } catch (\Exception $e) {
            Log::error('Pemeriksaan save error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateDiagnosa(Request $request, $no_registrasi)
    {
        try {
            $validator = Validator::make($request->all(), [
                'diagnosa' => 'required|string|max:50',
                'tindakan' => 'required|string|max:50'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $pemeriksaan = Pemeriksaan::where('no_registrasi', $no_registrasi)->first();
            if (!$pemeriksaan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data pemeriksaan tidak ditemukan'
                ], 404);
            }

            $rm = intval(now()->format('ymd') . rand(1000, 9999));
            DB::beginTransaction();
            $pemeriksaan->update([
                'diagnosa' => $request->diagnosa,
                'tindakan' => $request->tindakan,
                'rm' => $rm
            ]);

            // PERBAIKAN: Cek otentikasi dengan penanganan yang lebih baik
            $user = Auth::user();
            if ($user) {
                $dokter = \App\Models\Dokter::where('id_user', $user->id)->first();
                if ($dokter) {
                    StatusHistory::addStatus(
                        $no_registrasi,
                        'Selesai',
                        'dokter',
                        $dokter->id_dokter,
                        'Diagnosa selesai'
                    );
                }
            } else {
                Log::warning('User tidak ditemukan saat update diagnosa', ['no_registrasi' => $no_registrasi]);
                // Jika user tidak ditemukan, tetap lanjutkan tanpa status history
            }
            
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Diagnosa berhasil disimpan',
                'data' => $pemeriksaan
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating diagnosis: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan diagnosa',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}