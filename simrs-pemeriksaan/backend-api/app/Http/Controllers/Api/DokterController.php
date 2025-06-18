<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;

/**
 * @OA\Info(title="SIMRS API", version="1.0")
 */
class DokterController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/dokter",
     *     summary="Ambil daftar dokter",
     *     @OA\Response(response=200, description="Daftar dokter")
     * )
     */
    public function index()
    {
        $dokters = Dokter::all();
        return response()->json($dokters);
    }

    /**
     * @OA\Post(
     *     path="/api/dokter",
     *     summary="Tambah dokter baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_user", type="integer", example=1),
     *             @OA\Property(property="nama_dokter", type="string", example="Dr. Smith"),
     *             @OA\Property(property="no_hp_dokter", type="string", example="08123456789"),
     *             @OA\Property(property="spesialis", type="string", example="Umum")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Dokter yang baru dibuat")
     * )
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
     * @OA\Put(
     *     path="/api/dokter/{dokter}",
     *     summary="Update data dokter",
     *     @OA\Parameter(name="dokter", in="path", required=true, description="ID Dokter"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_user", type="integer", example=1),
     *             @OA\Property(property="nama_dokter", type="string", example="Dr. Smith"),
     *             @OA\Property(property="no_hp_dokter", type="string", example="08123456789"),
     *             @OA\Property(property="spesialis", type="string", example="Umum")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Dokter yang sudah diupdate")
     * )
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
     * @OA\Delete(
     *     path="/api/dokter/{dokter}",
     *     summary="Hapus dokter tertentu",
     *     @OA\Parameter(name="dokter", in="path", required=true, description="ID Dokter"),
     *     @OA\Response(response=204, description="No Content")
     * )
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return response()->json(null, 204);
    }
}
