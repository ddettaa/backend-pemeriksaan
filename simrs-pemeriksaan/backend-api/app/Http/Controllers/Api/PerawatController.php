<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat;

/**
 * @OA\Info(title="SIMRS API", version="1.0")
 */
class PerawatController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/perawat",
     *     summary="Ambil daftar perawat",
     *     @OA\Response(response=200, description="Daftar perawat")
     * )
     */
    public function index()
    {
        $perawats = Perawat::all();
        return response()->json($perawats);
    }

    /**
     * @OA\Post(
     *     path="/api/perawat",
     *     summary="Tambah perawat baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_user", type="integer", example=1),
     *             @OA\Property(property="nama_perawat", type="string", example="John Doe"),
     *             @OA\Property(property="no_hp_perawat", type="string", example="08123456789")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Perawat yang baru dibuat")
     * )
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
     * @OA\Put(
     *     path="/api/perawat/{perawat}",
     *     summary="Update data perawat",
     *     @OA\Parameter(name="perawat", in="path", required=true, description="ID Perawat"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_user", type="integer", example=1),
     *             @OA\Property(property="nama_perawat", type="string", example="John Doe"),
     *             @OA\Property(property="no_hp_perawat", type="string", example="08123456789")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Perawat yang sudah diupdate")
     * )
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
     * @OA\Delete(
     *     path="/api/perawat/{perawat}",
     *     summary="Hapus perawat tertentu",
     *     @OA\Parameter(name="perawat", in="path", required=true, description="ID Perawat"),
     *     @OA\Response(response=204, description="No Content")
     * )
     */
    public function destroy(Perawat $perawat)
    {
        $perawat->delete();
        return response()->json(null, 204);
    }
}
