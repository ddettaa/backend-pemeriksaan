<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat;

/**
 * @api
 * SIMRS API - Endpoint untuk data perawat
 */
class PerawatController extends Controller
{
    /**
     * Ambil daftar seluruh perawat.
     *
     * @group Perawat
     *
     * @response 200 [
     *   {
     *     "id_perawat": 1,
     *     "id_user": 1,
     *     "nama_perawat": "John Doe",
     *     "no_hp_perawat": "08123456789"
     *   }
     * ]
     */
    public function index()
    {
        $perawats = Perawat::all();
        return response()->json($perawats);
    }

    /**
     * Tambah perawat baru.
     *
     * @group Perawat
     *
     * @bodyParam id_user integer required ID dari user yang terkait. Example: 1
     * @bodyParam nama_perawat string required Nama lengkap perawat. Example: John Doe
     * @bodyParam no_hp_perawat string required Nomor HP perawat. Example: 08123456789
     *
     * @response 201 {
     *   "id_perawat": 2,
     *   "id_user": 1,
     *   "nama_perawat": "John Doe",
     *   "no_hp_perawat": "08123456789"
     * }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|integer|exists:users,id_user',
            'nama_perawat' => 'required|string',
            'no_hp_perawat' => 'required|string',
        ]);

        $perawat = Perawat::create($data);
        return response()->json($perawat, 201);
    }

    /**
     * Ambil detail dari satu perawat.
     *
     * @group Perawat
     *
     * @urlParam perawat integer required ID perawat yang ingin ditampilkan. Example: 1
     *
     * @response 200 {
     *   "id_perawat": 1,
     *   "id_user": 1,
     *   "nama_perawat": "John Doe",
     *   "no_hp_perawat": "08123456789"
     * }
     */
    public function show(Perawat $perawat)
    {
        return response()->json($perawat);
    }

    /**
     * Perbarui data perawat tertentu.
     *
     * @group Perawat
     *
     * @urlParam perawat integer required ID perawat yang akan diupdate. Example: 1
     * @bodyParam id_user integer required ID dari user. Example: 1
     * @bodyParam nama_perawat string required Nama lengkap perawat. Example: John Doe
     * @bodyParam no_hp_perawat string required Nomor HP perawat. Example: 08123456789
     *
     * @response 200 {
     *   "id_perawat": 1,
     *   "id_user": 1,
     *   "nama_perawat": "John Doe",
     *   "no_hp_perawat": "08123456789"
     * }
     */
    public function update(Request $request, Perawat $perawat)
    {
        $data = $request->validate([
            'id_user' => 'required|integer|exists:users,id_user',
            'nama_perawat' => 'required|string',
            'no_hp_perawat' => 'required|string',
        ]);

        $perawat->update($data);
        return response()->json($perawat);
    }

    /**
     * Hapus perawat berdasarkan ID.
     *
     * @group Perawat
     *
     * @urlParam perawat integer required ID perawat yang akan dihapus. Example: 1
     *
     * @response 204 {
     *   "message": "Perawat berhasil dihapus"
     * }
     */
    public function destroy(Perawat $perawat)
    {
        $perawat->delete();
        return response()->json(null, 204);
    }
}
