<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\StatusHistoryController;
use App\Http\Controllers\Api\EResepController;
use App\Http\Controllers\Api\DetailEResepController;
use App\Http\Controllers\Api\DokterController;
use App\Http\Controllers\Api\PerawatController;
use App\Http\Controllers\Api\PoliController;

// -------------------
// PUBLIC ROUTES
// -------------------

// Jadwal dokter (public)
Route::get('/jadwal-dokter', [JadwalController::class, 'jadwalDokter']);
Route::get('/jadwal', [JadwalController::class, 'index']);

// User info (for debugging, not protected)
Route::get('/user', function (Request $request) {
    return $request->user();
});

// Auth routes (public)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Resource routes (public)
Route::apiResource('e-resep', EResepController::class);
Route::apiResource('e-resepdetail', DetailEResepController::class);
Route::apiResource('dokter', DokterController::class);
Route::apiResource('perawat', PerawatController::class);
Route::apiResource('poli', PoliController::class);

// -------------------
// PROTECTED ROUTES (with authentication)
// -------------------

// Pemeriksaan routes (protected with auth middleware)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/pemeriksaan', [PemeriksaanController::class, 'index']);
    Route::post('/pemeriksaan', [PemeriksaanController::class, 'store']);
    Route::get('/pemeriksaan/{no_registrasi}', [PemeriksaanController::class, 'show']);
    Route::put('/pemeriksaan/{no_registrasi}/diagnosa', [PemeriksaanController::class, 'updateDiagnosa']);
});

// Status history routes (protected with auth middleware)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/status/{noReg}/current', [StatusHistoryController::class, 'getCurrentStatus']);
    Route::get('/status/{noReg}/history', [StatusHistoryController::class, 'getStatusHistory']);
    Route::post('/status', [StatusHistoryController::class, 'addStatus']);
});

// -------------------
// TEST ROUTES (public for debugging)
// -------------------

Route::get('/test-data/{no_registrasi}', function ($no_registrasi) {
    $response = Http::get('https://ti054a01.agussbn.my.id/api/pendaftaran/' . $no_registrasi);
    $pasien = $response->successful() ? $response->json() : null;
    $pemeriksaan = DB::table('pemeriksaan')->where('no_registrasi', $no_registrasi)->first();
    return response()->json([
        'input_no_registrasi' => $no_registrasi,
        'pasien_exists'       => !is_null($pasien),
        'pasien_data'         => $pasien,
        'pemeriksaan_exists'  => !is_null($pemeriksaan),
        'pemeriksaan_data'    => $pemeriksaan,
    ]);
});

Route::get('/test-pemeriksaan/{no_registrasi}', function ($no_registrasi) {
    try {
        $response = Http::get('https://ti054a01.agussbn.my.id/api/pendaftaran/' . $no_registrasi);
        $pasien = $response->successful() ? $response->json() : null;
        $data = DB::table('pemeriksaan')->where('no_registrasi', $no_registrasi)->first();
        return response()->json([
            'pemeriksaan_exists' => !is_null($data),
            'pemeriksaan_data'   => $data,
            'pasien_exists'      => !is_null($pasien),
            'pasien_data'        => $pasien,
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
        'data'  => $data,
    ]);
});

Route::get('/test-tables', function () {
    $pemeriksaan = DB::table('pemeriksaan')->get();
    $response    = Http::get('https://ti054a01.agussbn.my.id/api/pendaftaran');
    $pasienList  = $response->successful() ? $response->json() : [];
    return response()->json([
        'pemeriksaan_count' => $pemeriksaan->count(),
        'pemeriksaan_data'  => $pemeriksaan,
        'pasien_count'      => count($pasienList),
        'pasien_data'       => $pasienList,
    ]);
});