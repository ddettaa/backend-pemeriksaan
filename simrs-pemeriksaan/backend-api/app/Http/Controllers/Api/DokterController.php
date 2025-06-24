<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;

/**
 * @api
 * SIMRS API - Endpoint untuk data dokter
 */
class DokterController extends Controller
{
    /**
     * Ambil daftar semua dokter.
     *
     * @group Dokter
     *
     * @response 200 [
     *   {
     *     "id_dokter": 1,
     *     "id_user": 1,
     *     "nama_dokter": "Dr. Smith",
     *     "no_hp_dokter": "08123456789",
     *     "spesialis": "Umum"
     *   }
     * ]
     */
    public function index()
    {
        $dokters = Dokter::all();
        return response()->json($dokters);
    }

    /**
     * Tambah dokter baru.
     *
     * @group Dokter
     *
     * @bodyParam id_user integer required ID user. Example: 1
     * @bodyParam nama_dokter string required Nama lengkap dokter. Example: Dr. Smith
     * @bodyParam no_hp_dokter string required Nomor HP dokter. Example: 08123456789
     * @bodyParam spesialis string required Spesialisasi dokter. Example: Umum
     *
     * @response 201 {
     *   "id_dokter": 2,
     *   "id_user": 1,
     *   "nama_dokter": "Dr. Smith",
     *   "no_hp_dokter": "08123456789",
     *   "spesialis": "Umum"
     * }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|integer|exists:users,id_user',
            'nama_dokter' => 'required|string',
            'no_hp_dokter' => 'required|string',
            'spesialis' => 'required|string',
        ]);

        $dokter = Dokter::create($data);
        return response()->json($dokter, 201);
    }

    /**
     * Lihat detail dokter tertentu.
     *
     * @group Dokter
     *
     * @urlParam dokter integer required ID dokter yang ingin ditampilkan. Example: 1
     *
     * @response 200 {
     *   "id_dokter": 1,
     *   "id_user": 1,
     *   "nama_dokter": "Dr. Smith",
     *   "no_hp_dokter": "08123456789",
     *   "spesialis": "Umum"
     * }
     */
    public function show(Dokter $dokter)
    {
        return response()->json($dokter);
    }

    /**
     * Update data dokter.
     *
     * @group Dokter
     *
     * @urlParam dokter integer required ID dokter yang akan diupdate. Example: 1
     * @bodyParam id_user integer required ID user. Example: 1
     * @bodyParam nama_dokter string required Nama dokter. Example: Dr. Smith
     * @bodyParam no_hp_dokter string required Nomor HP dokter. Example: 08123456789
     * @bodyParam spesialis string required Spesialisasi dokter. Example: Umum
     *
     * @response 200 {
     *   "id_dokter": 1,
     *   "id_user": 1,
     *   "nama_dokter": "Dr. Smith",
     *   "no_hp_dokter": "08123456789",
     *   "spesialis": "Umum"
     * }
     */
    public function update(Request $request, Dokter $dokter)
    {
        $data = $request->validate([
            'id_user' => 'required|integer|exists:users,id_user',
            'nama_dokter' => 'required|string',
            'no_hp_dokter' => 'required|string',
            'spesialis' => 'required|string',
        ]);

        $dokter->update($data);
        return response()->json($dokter);
    }

    /**
     * Hapus dokter tertentu.
     *
     * @group Dokter
     *
     * @urlParam dokter integer required ID dokter yang akan dihapus. Example: 1
     *
     * @response 204 {
     *   "message": "Dokter berhasil dihapus"
     * }
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return response()->json(null, 204);
    }
}
