<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EResep;
use App\Models\DetailEResep;
use Illuminate\Http\Request;

class DetailEResepController extends Controller
{
    /**
     * Tampilkan semua detail e-resep tertentu.
     *
     * @group Detail E-Resep
     *
     * @urlParam e_resep integer required ID dari e-resep. Example: 1
     *
     * @response 200 [
     *   {
     *     "id": 1,
     *     "id_obat": 5,
     *     "jumlah": 2,
     *     "aturan_pakai": "3x1 sesudah makan"
     *   }
     * ]
     */
    public function index(EResep $e_resep)
    {
        $details = $e_resep->details()->get();
        return response()->json($details);
    }

    /**
     * Simpan detail resep baru untuk e-resep tertentu.
     *
     * @group Detail E-Resep
     *
     * @urlParam e_resep integer required ID dari e-resep. Example: 1
     * @bodyParam id_obat integer required ID obat yang diresepkan. Example: 5
     * @bodyParam jumlah integer required Jumlah obat. Example: 2
     * @bodyParam aturan_pakai string required Aturan penggunaan obat. Example: 3x1 sesudah makan
     *
     * @response 201 {
     *   "id": 10,
     *   "id_obat": 5,
     *   "jumlah": 2,
     *   "aturan_pakai": "3x1 sesudah makan"
     * }
     */
    public function store(Request $request, EResep $e_resep)
    {
        $data = $request->validate([
            'id_obat'      => 'required|integer',
            'jumlah'       => 'required|integer',
            'aturan_pakai' => 'required|string',
        ]);

        $detail = $e_resep->details()->create($data);
        return response()->json($detail, 201);
    }

    /**
     * Tampilkan detail resep tertentu.
     *
     * @group Detail E-Resep
     *
     * @urlParam e_resep integer required ID dari e-resep. Example: 1
     * @urlParam detail_e_resep integer required ID dari detail resep. Example: 10
     *
     * @response 200 {
     *   "id": 10,
     *   "id_obat": 5,
     *   "jumlah": 2,
     *   "aturan_pakai": "3x1 sesudah makan"
     * }
     */
    public function show(EResep $e_resep, DetailEResep $detail_e_resep)
    {
        return response()->json($detail_e_resep);
    }

    /**
     * Perbarui detail resep.
     *
     * @group Detail E-Resep
     *
     * @urlParam e_resep integer required ID dari e-resep. Example: 1
     * @urlParam detail_e_resep integer required ID dari detail resep. Example: 10
     * @bodyParam id_obat integer optional ID obat. Example: 6
     * @bodyParam jumlah integer optional Jumlah obat. Example: 3
     * @bodyParam aturan_pakai string optional Aturan pakai. Example: 2x1 sebelum makan
     *
     * @response 200 {
     *   "id": 10,
     *   "id_obat": 6,
     *   "jumlah": 3,
     *   "aturan_pakai": "2x1 sebelum makan"
     * }
     */
    public function update(Request $request, EResep $e_resep, DetailEResep $detail_e_resep)
    {
        $data = $request->validate([
            'id_obat'      => 'sometimes|required|integer',
            'jumlah'       => 'sometimes|required|integer',
            'aturan_pakai' => 'sometimes|required|string',
        ]);

        $detail_e_resep->update($data);
        return response()->json($detail_e_resep);
    }

    /**
     * Hapus detail resep.
     *
     * @group Detail E-Resep
     *
     * @urlParam e_resep integer required ID dari e-resep. Example: 1
     * @urlParam detail_e_resep integer required ID dari detail resep. Example: 10
     *
     * @response 204 {
     *   "message": "Berhasil dihapus"
     * }
     */
    public function destroy(EResep $e_resep, DetailEResep $detail_e_resep)
    {
        $detail_e_resep->delete();
        return response()->json(null, 204);
    }
}
