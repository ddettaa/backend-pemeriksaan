<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Perawat;
use App\Models\Dokter;
use App\Models\StatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PemeriksaanController extends Controller
{
    /**
     * @group Pemeriksaan
     * 
     * Ambil daftar seluruh pemeriksaan beserta data pasien dari API eksternal.
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": [
     *     {
     *       "pasien": {
     *         "no_registrasi": 1,
     *         "rm": 12345,
     *         // ...data pasien lain...
     *       },
     *       "pemeriksaan": {
     *         "no_registrasi": 1,
     *         "rm": 12345,
     *         "suhu": 370,
     *         "tensi": "120/80",
     *         "tinggi_badan": 170,
     *         "berat_badan": 65,
     *         "keluhan": "Pusing",
     *         "diagnosa": "Flu",
     *         "tindakan": "Obat",
     *         "id_perawat": 1,
     *         "id_dokter": 2
     *       }
     *     }
     *   ]
     * }
     */
    public function index()
    {
        try {
            Log::info('Fetching all examinations');

            $apiResp = Http::get('https://ti054a01.agussbn.my.id/api/pendaftaran');
            if (!$apiResp->successful()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengambil daftar pasien dari API'
                ], 500);
            }

            $pasienList = $apiResp->json('data');
            if (!is_array($pasienList)) {
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
                    'pemeriksaan' => $pemeriksaanList->get($no) ?? null
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

    /**
     * @group Pemeriksaan
     * 
     * Ambil detail pemeriksaan dan data pasien berdasarkan nomor registrasi.
     * 
     * @urlParam no_registrasi integer required Nomor registrasi pasien. Example: 1
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {
     *     "pasien": {
     *       "no_registrasi": 1,
     *       "rm": 12345,
     *       "jenis_kelamin": "L",
     *       // ...data pasien lain...
     *     },
     *     "pemeriksaan": {
     *       "no_registrasi": 1,
     *       "rm": 12345,
     *       "suhu": 370,
     *       "tensi": "120/80",
     *       "tinggi_badan": 170,
     *       "berat_badan": 65,
     *       "keluhan": "Pusing",
     *       "diagnosa": "Flu",
     *       "tindakan": "Obat",
     *       "id_perawat": 1,
     *       "id_dokter": 2
     *     }
     *   }
     * }
     * @response 404 {
     *   "status": "error",
     *   "message": "Data pasien tidak ditemukan di API"
     * }
     */
    public function show($no_registrasi)
    {
        try {
            Log::info('Fetching examination for: ' . $no_registrasi);

            $apiResp = Http::get("https://ti054a01.agussbn.my.id/api/pendaftaran/{$no_registrasi}");
if (!$apiResp->successful()) {
    return response()->json([
        'status' => 'error',
        'message' => 'Data pasien tidak ditemukan di API'
    ], 404);
}

$pasienData = $apiResp->json('data');
if (is_array($pasienData) && isset($pasienData[0])) {
    $pasienData = $pasienData[0];
}

if (empty($pasienData) || !is_array($pasienData)) {
    return response()->json([
        'status' => 'error',
        'message' => 'Data pasien tidak valid'
    ], 500);
}

$jenisKelamin = null;
$rm = isset($pasienData['rm']) ? $pasienData['rm'] : null;
Log::info('RM yang akan dicari ke API pasien:', [$rm]);
if (!empty($rm)) {
    $pasienResp = Http::get("https://ti054a01.agussbn.my.id/api/pasien/{$rm}");
    Log::info('Status response API pasien:', [$pasienResp->status()]);
    if ($pasienResp->successful()) {
        $detailPasien = $pasienResp->json('data');
        Log::info('Detail pasien dari API pasien:', [$detailPasien]);
        if (is_array($detailPasien) && isset($detailPasien[0])) {
            $detailPasien = $detailPasien[0];
        }
        $jenisKelamin = $detailPasien['jns_kelamin'] ?? null;
    } else {
        Log::warning('Gagal mendapatkan data dari API pasien', [$pasienResp->body()]);
    }
}
$pasienData['jenis_kelamin'] = $jenisKelamin;

$pemeriksaan = DB::table('pemeriksaan')->where('no_registrasi', $no_registrasi)->first();

if (!$pemeriksaan) {
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

    /**
     * @group Pemeriksaan
     * 
     * Simpan data pemeriksaan baru atau update jika sudah ada.
     * 
     * @bodyParam no_registrasi integer required Nomor registrasi pasien. Example: 1
     * @bodyParam rm integer Nomor rekam medis. Example: 12345
     * @bodyParam suhu integer required Suhu tubuh (350-450). Example: 370
     * @bodyParam tensi string required Tekanan darah (format: 120/80). Example: 120/80
     * @bodyParam tinggi_badan integer required Tinggi badan (30-300 cm). Example: 170
     * @bodyParam berat_badan integer required Berat badan (1-500 kg). Example: 65
     * @bodyParam keluhan string required Keluhan pasien. Example: Pusing
     * @bodyParam diagnosa string Diagnosa. Example: Flu
     * @bodyParam tindakan string Tindakan. Example: Obat
     * 
     * @response 201 {
     *   "status": "success",
     *   "message": "Data berhasil disimpan",
     *   "data": {
     *     "no_registrasi": 1,
     *     "rm": 12345,
     *     "suhu": 370,
     *     "tensi": "120/80",
     *     "tinggi_badan": 170,
     *     "berat_badan": 65,
     *     "keluhan": "Pusing",
     *     "diagnosa": "Flu",
     *     "tindakan": "Obat",
     *     "id_perawat": 1,
     *     "id_dokter": null
     *   }
     * }
     * @response 422 {
     *   "status": "error",
     *   "message": "Validasi gagal",
     *   "errors": {
     *     "suhu": ["The suhu must be between 350 and 450."]
     *   }
     * }
     */
    public function store(Request $request)
    {
        try {
            Log::info('Request diterima di store():', $request->all());

            $validator = Validator::make($request->all(), [
                'no_registrasi' => 'required|integer',
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
                Log::warning('Validasi gagal:', $validator->errors()->toArray());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->only([
                'no_registrasi', 'rm', 'suhu', 'tensi', 'tinggi_badan',
                'berat_badan', 'keluhan', 'diagnosa', 'tindakan'
            ]);

            // Ambil RM dari API jika kosong
            if (empty($data['rm'])) {
                Log::info('RM kosong, mencoba mengambil dari API pendaftaran...');
                $pendaftaranResp = Http::get("https://ti054a01.agussbn.my.id/api/pendaftaran/{$request->no_registrasi}");

                if ($pendaftaranResp->successful()) {
                    $apiData = $pendaftaranResp->json('data');
                    $pasien = is_array($apiData) ? collect($apiData)->first() : $apiData;
                    $data['rm'] = $pasien['rm'] ?? null;
                    Log::info('RM diambil dari API:', ['rm' => $data['rm']]);
                } else {
                    Log::warning('Gagal mengambil data dari API pendaftaran.');
                }
            }

            if (empty($data['rm'])) {
                Log::error('RM tetap kosong setelah usaha pengambilan dari API');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nomor rekam medis (RM) tidak ditemukan'
                ], 400);
            }

            $user = Auth::user();
            if (!$user) {
                Log::error('User tidak login');
                return response()->json([
                    'status' => 'error',
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            $perawat = Perawat::where('id_user', $user->id_user)->first();
            if (!$perawat) {
                Log::error('Perawat tidak ditemukan');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Perawat tidak ditemukan'
                ], 403);
            }

            $data['id_perawat'] = $perawat->id_perawat;

            $pemeriksaan = DB::transaction(function () use ($data, $request, $perawat) {
               $record = Pemeriksaan::updateOrCreate(
                ['no_registrasi' => $data['no_registrasi']],
                $data
);

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
            Log::error('Gagal simpan pemeriksaan: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @group Pemeriksaan
     * 
     * Update diagnosa dan tindakan oleh dokter.
     * 
     * @urlParam no_registrasi integer required Nomor registrasi pasien. Example: 1
     * @bodyParam diagnosa string required Diagnosa. Example: Flu
     * @bodyParam tindakan string required Tindakan. Example: Obat
     * 
     * @response 200 {
     *   "status": "success",
     *   "message": "Diagnosa berhasil disimpan",
     *   "data": {
     *     "no_registrasi": 1,
     *     "diagnosa": "Flu",
     *     "tindakan": "Obat",
     *     "id_dokter": 2
     *   }
     * }
     * @response 404 {
     *   "status": "error",
     *   "message": "Data pemeriksaan tidak ditemukan"
     * }
     * @response 422 {
     *   "status": "error",
     *   "message": "Validasi gagal",
     *   "errors": {
     *     "diagnosa": ["The diagnosa field is required."]
     *   }
     * }
     */
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

            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            $dokter = Dokter::where('id_user', $user->id_user)->first();
            if (!$dokter) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Dokter tidak ditemukan'
                ], 403);
            }

            DB::beginTransaction();

            $pemeriksaan->update([
                'diagnosa' => $request->diagnosa,
                'tindakan' => $request->tindakan,
                'id_dokter' => $dokter->id_dokter
            ]);

            StatusHistory::addStatus(
                $no_registrasi,
                'Selesai',
                'dokter',
                $dokter->id_dokter,
                'Diagnosa selesai'
            );

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
