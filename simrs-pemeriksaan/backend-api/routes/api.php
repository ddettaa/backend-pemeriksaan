<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PasienController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\StatusHistoryController;
use App\Http\Controllers\Api\EResepController;
use App\Http\Controllers\Api\DetailEResepController;

Route::get('/jadwal-dokter', [JadwalController::class, 'jadwalDokter']);
Route::get('/jadwal', [JadwalController::class, 'index']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::apiResource('e-resep', EResepController::class);
Route::apiResource('e-resepdetail', DetailEResepController::class);
// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pasien', [PasienController::class, 'index']);

    // Test routes to check data
    Route::get('/test-data/{no_registrasi}', function ($no_registrasi) {
        $pasien = DB::table('pasien')->where('no_reg', $no_registrasi)->first();
        $pemeriksaan = DB::table('pemeriksaan')->where('no_registrasi', $no_registrasi)->first();
        $pemeriksaanModel = \App\Models\Pemeriksaan::with('pasien')->where('no_registrasi', $no_registrasi)->first();

        return response()->json([
            'input_no_registrasi' => $no_registrasi,
            'pasien_exists' => !is_null($pasien),
            'pasien_data' => $pasien,
            'pemeriksaan_exists' => !is_null($pemeriksaan),
            'pemeriksaan_data' => $pemeriksaan,
            'pemeriksaan_with_relation' => $pemeriksaanModel,
        ]);
    });

    Route::get('/test-pemeriksaan/{no_registrasi}', function ($no_registrasi) {
        try {
            $data = DB::table('pemeriksaan')->where('no_registrasi', $no_registrasi)->first();
            $pasien = DB::table('pasien')->where('no_reg', $no_registrasi)->first();

            return response()->json([
                'pemeriksaan_exists' => !is_null($data),
                'pemeriksaan_data' => $data,
                'pasien_exists' => !is_null($pasien),
                'pasien_data' => $pasien,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    });

    Route::get('/test-pemeriksaan', function () {
        $data = DB::table('pemeriksaan')->get();
        return response()->json([
            'count' => $data->count(),
            'data' => $data,
        ]);
    });

    Route::get('/test-tables', function () {
        $pemeriksaan = DB::table('pemeriksaan')->get();
        $pasien = DB::table('pasien')->get();
        return response()->json([
            'pemeriksaan_count' => $pemeriksaan->count(),
            'pemeriksaan_data' => $pemeriksaan,
            'pasien_count' => $pasien->count(),
            'pasien_data' => $pasien,
        ]);
    });

    Route::post('/pemeriksaan', [PemeriksaanController::class, 'store']);
    Route::get('/pemeriksaan/{no_registrasi}', [PemeriksaanController::class, 'show']);
    Route::put('/pemeriksaan/{no_registrasi}/diagnosa', [PemeriksaanController::class, 'updateDiagnosa']);

    Route::get('/status/{noReg}/current', [StatusHistoryController::class, 'getCurrentStatus']);
    Route::get('/status/{noReg}/history', [StatusHistoryController::class, 'getStatusHistory']);
    Route::post('/status', [StatusHistoryController::class, 'addStatus']);

    
});
