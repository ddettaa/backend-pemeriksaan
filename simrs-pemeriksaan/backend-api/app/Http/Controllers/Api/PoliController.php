<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;

/**
 * @api
 * SIMRS API - Endpoint untuk data poli
 */
class PoliController extends Controller
{
    /**
     * Ambil daftar semua poli.
     *
     * @group Poli
     *
     * @response 200 [
     *   {
     *     "id_poli": 1,
     *     "id_perawat": 1,
     *     "id_dokter": 1,
     *     "nama_poli": "Poli Umum"
     *   }
     * ]
     */
    public function index()
    {
        $polis = Poli::all();
        return response()->json($polis);
    }

    /**
     * Tambah poli baru.
     *
     * @group Poli
     *
     * @bodyParam id_perawat integer required ID perawat yang bertugas. Example: 1
     * @bodyParam id_dokter integer required ID dokter yang bertugas. Example: 1
     * @bodyParam nama_poli string required Nama poli. Example: Poli Umum
     *
     * @response 201 {
     *   "id_poli": 2,
     *   "id_perawat": 1,
     *   "id_dokter": 1,
     *   "nama_poli": "Poli Umum"
     * }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_perawat' => 'required|integer|exists:perawat,id_perawat',
            'id_dokter' => 'required|integer|exists:dokter,id_dokter',
            'nama_poli' => 'required|string',
        ]);

        $poli = Poli::create($data);
        return response()->json($poli, 201);
    }

    /**
     * Ambil detail dari satu poli.
     *
     * @group Poli
     *
     * @urlParam poli integer required ID dari poli yang ingin dilihat. Example: 1
     *
     * @response 200 {
     *   "id_poli": 1,
     *   "id_perawat": 1,
     *   "id_dokter": 1,
     *   "nama_poli": "Poli Umum"
     * }
     */
    public function show(Poli $poli)
    {
        return response()->json($poli);
    }

    /**
     * Perbarui data poli tertentu.
     *
     * @group Poli
     *
     * @urlParam poli integer required ID poli yang akan diperbarui. Example: 1
     * @bodyParam id_perawat integer required ID perawat baru. Example: 2
     * @bodyParam id_dokter integer required ID dokter baru. Example: 3
     * @bodyParam nama_poli string required Nama poli baru. Example: Poli Gigi
     *
     * @response 200 {
     *   "id_poli": 1,
     *   "id_perawat": 2,
     *   "id_dokter": 3,
     *   "nama_poli": "Poli Gigi"
     * }
     */
    public function update(Request $request, Poli $poli)
    {
        $data = $request->validate([
            'id_perawat' => 'required|integer|exists:perawat,id_perawat',
            'id_dokter' => 'required|integer|exists:dokter,id_dokter',
            'nama_poli' => 'required|string',
        ]);

        $poli->update($data);
        return response()->json($poli);
    }

    /**
     * Hapus data poli tertentu.
     *
     * @group Poli
     *
     * @urlParam poli integer required ID poli yang akan dihapus. Example: 1
     *
     * @response 204 {
     *   "message": "Poli berhasil dihapus"
     * }
     */
    public function destroy(Poli $poli)
    {
        $poli->delete();
        return response()->json(null, 204);
    }
}
