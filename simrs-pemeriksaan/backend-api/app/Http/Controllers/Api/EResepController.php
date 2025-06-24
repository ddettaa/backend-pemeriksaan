<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EResep;
use Illuminate\Http\Request;

/**
 * @api
 * SIMRS API - Endpoint untuk data E-Resep
 */
class EResepController extends Controller
{
    /**
     * Ambil semua data e-resep beserta detailnya.
     *
     * @group EResep
     *
     * @response 200 [
     *   {
     *     "id": 1,
     *     "no_registrasi": "12345",
     *     "details": [
     *       {
     *         "id_obat": 1,
     *         "jumlah": 2,
     *         "aturan_pakai": "3x sehari"
     *       }
     *     ]
     *   }
     * ]
     */
    public function index()
    {
        $reseps = EResep::with('details')->get();
        return response()->json($reseps);
    }

    /**
     * Tambah data e-resep baru.
     *
     * @group EResep
     *
     * @bodyParam no_registrasi string required Nomor registrasi pasien. Example: 12345
     *
     * @response 201 {
     *   "id": 1,
     *   "no_registrasi": "12345",
     *   "details": []
     * }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'no_registrasi' => 'required|string',
        ]);

        $resep = EResep::create($data);
        $resep->load('details');

        return response()->json($resep, 201);
    }

    /**
     * Tampilkan detail e-resep tertentu.
     *
     * @group EResep
     *
     * @urlParam e_resep integer required ID resep yang ingin ditampilkan. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "no_registrasi": "12345",
     *   "details": [
     *     {
     *       "id_obat": 1,
     *       "jumlah": 2,
     *       "aturan_pakai": "3x sehari"
     *     }
     *   ]
     * }
     */
    public function show(EResep $e_resep)
    {
        $e_resep->load('details');
        return response()->json($e_resep);
    }

    /**
     * Update data e-resep tertentu.
     *
     * @group EResep
     *
     * @urlParam e_resep integer required ID resep yang akan diupdate. Example: 1
     * @bodyParam no_registrasi string Nomor registrasi baru. Example: 12345
     *
     * @response 200 {
     *   "id": 1,
     *   "no_registrasi": "12345",
     *   "details": []
     * }
     */
    public function update(Request $request, EResep $e_resep)
    {
        $data = $request->validate([
            'no_registrasi' => 'sometimes|required|string',
        ]);

        $e_resep->update($data);
        $e_resep->load('details');

        return response()->json($e_resep);
    }

    /**
     * Hapus data e-resep tertentu.
     *
     * @group EResep
     *
     * @urlParam e_resep integer required ID resep yang ingin dihapus. Example: 1
     *
     * @response 204 {
     *   "message": "Data berhasil dihapus"
     * }
     */
    public function destroy(EResep $e_resep)
    {
        $e_resep->delete();
        return response()->json(null, 204);
    }
}
