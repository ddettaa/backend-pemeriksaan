<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;

/**
 * @OA\Info(title="SIMRS API", version="1.0")
 */
class PoliController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/poli",
     *     summary="Ambil daftar poli",
     *     @OA\Response(response=200, description="Daftar poli")
     * )
     */
    public function index()
    {
        $polis = Poli::all();
        return response()->json($polis);
    }

    /**
     * @OA\Post(
     *     path="/api/poli",
     *     summary="Tambah poli baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_perawat", type="integer", example=1),
     *             @OA\Property(property="id_dokter", type="integer", example=1),
     *             @OA\Property(property="nama_poli", type="string", example="Poli Umum")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Poli yang baru dibuat")
     * )
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
     * @OA\Put(
     *     path="/api/poli/{poli}",
     *     summary="Update data poli",
     *     @OA\Parameter(name="poli", in="path", required=true, description="ID Poli"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_perawat", type="integer", example=1),
     *             @OA\Property(property="id_dokter", type="integer", example=1),
     *             @OA\Property(property="nama_poli", type="string", example="Poli Umum")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Poli yang sudah diupdate")
     * )
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
     * @OA\Delete(
     *     path="/api/poli/{poli}",
     *     summary="Hapus poli tertentu",
     *     @OA\Parameter(name="poli", in="path", required=true, description="ID Poli"),
     *     @OA\Response(response=204, description="No Content")
     * )
     */
    public function destroy(Poli $poli)
    {
        $poli->delete();
        return response()->json(null, 204);
    }
}
