<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EResep;
use App\Models\EResepDetail;
use Illuminate\Http\Request;

class DetailEResepController extends Controller
{
    /**
     * @group EResep Detail
     * 
     * Tampilkan semua detail e-resep tertentu.
     * 
     * @urlParam e_resep integer required ID e-resep. Example: 1
     * 
     * @response 200 [
     *   {
     *     "id_resep": 1,
     *     "id_obat": "OBT001",
     *     "jumlah": 2,
     *     "aturan_pakai": "3x1"
     *   }
     * ]
     */
    public function index(EResep $e_resep)
    {
        // $details = $e_resep->details()->get();
        // return response()->json($details);
        $details = EResepDetail::all(['id_resep', 'id_obat', 'jumlah', 'aturan_pakai']);
        return response()->json($details);
    }

    /**
     * @group EResep Detail
     * 
     * Simpan detail resep baru untuk e-resep tertentu.
     * 
     * @urlParam e_resep integer required ID e-resep. Example: 1
     * @bodyParam id_obat string required ID obat. Example: OBT001
     * @bodyParam jumlah integer required Jumlah obat. Example: 2
     * @bodyParam aturan_pakai string required Aturan pakai. Example: 3x1
     * 
     * @response 201 {
     *   "id_resep": 1,
     *   "id_obat": "OBT001",
     *   "jumlah": 2,
     *   "aturan_pakai": "3x1"
     * }
     */
    public function store(Request $request, EResep $e_resep)
    {
        $data = $request->validate([
            'id_obat'      => 'required|string',
            'jumlah'       => 'required',
            'aturan_pakai' => 'required|string',
        ]);
        $data['id_resep'] = $e_resep->id_resep; // <-- gunakan id_resep

        $detail = EResepDetail::create($data);
        // hanya tampilkan field yang diinginkan
        return response()->json([
            'id_resep'     => $detail->id_resep,
            'id_obat'      => $detail->id_obat,
            'jumlah'       => $detail->jumlah,
            'aturan_pakai' => $detail->aturan_pakai,
        ], 201);
    }

    /**
     * @group EResep Detail
     * 
     * Tampilkan detail resep tertentu.
     * 
     * @urlParam e_resep integer required ID e-resep. Example: 1
     * @urlParam detail_e_resep integer required ID detail resep. Example: 1
     * 
     * @response 200 {
     *   "id_resep": 1,
     *   "id_obat": "OBT001",
     *   "jumlah": 2,
     *   "aturan_pakai": "3x1"
     * }
     */
    public function show(EResep $e_resep, EResepDetail $detail_e_resep)
    {
        return response()->json([
            'id_resep'     => $detail_e_resep->id_resep,
            'id_obat'      => $detail_e_resep->id_obat,
            'jumlah'       => $detail_e_resep->jumlah,
            'aturan_pakai' => $detail_e_resep->aturan_pakai,
        ]);
    }

    /**
     * @group EResep Detail
     * 
     * Perbarui detail resep.
     * 
     * @urlParam e_resep integer required ID e-resep. Example: 1
     * @urlParam detail_e_resep integer required ID detail resep. Example: 1
     * @bodyParam id_obat string ID obat. Example: OBT001
     * @bodyParam jumlah integer Jumlah obat. Example: 2
     * @bodyParam aturan_pakai string Aturan pakai. Example: 3x1
     * 
     * @response 200 {
     *   "id_resep": 1,
     *   "id_obat": "OBT001",
     *   "jumlah": 2,
     *   "aturan_pakai": "3x1"
     * }
     */
    public function update(Request $request, EResep $e_resep, EResepDetail $detail_e_resep)
    {
        $data = $request->validate([
            'id_obat'      => 'sometimes|required|string',
            'jumlah'       => 'sometimes|required|integer',
            'aturan_pakai' => 'sometimes|required|string',
        ]);

        $detail_e_resep->update($data);

        return response()->json([
            'id_resep'     => $detail_e_resep->id_resep,
            'id_obat'      => $detail_e_resep->id_obat,
            'jumlah'       => $detail_e_resep->jumlah,
            'aturan_pakai' => $detail_e_resep->aturan_pakai,
        ]);
    }

    /**
     * @group EResep Detail
     * 
     * Hapus detail resep.
     * 
     * @urlParam e_resep integer required ID e-resep. Example: 1
     * @urlParam detail_e_resep integer required ID detail resep. Example: 1
     * 
     * @response 204 {
     *   "message": "Detail resep berhasil dihapus"
     * }
     */
    public function destroy(EResep $e_resep, EResepDetail $detail_e_resep)
    {
        $detail_e_resep->delete();
        return response()->json(['message' => 'Detail resep berhasil dihapus'], 204);
    }
}
