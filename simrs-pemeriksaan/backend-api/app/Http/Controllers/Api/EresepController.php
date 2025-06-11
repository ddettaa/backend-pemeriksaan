<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EResep;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="SIMRS API", version="1.0")
 */
class EResepController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/e-resep",
     *     summary="Ambil daftar resep beserta detailnya",
     *     @OA\Response(response=200, description="Daftar resep")
     * )
     */
    /**
     * Ambil daftar resep beserta detailnya.
     *
     * @group EResep
     * @response 200 [
     *     {
     *         "id": 1,
     *         "no_registrasi": "12345",
     *         "details": [
     *             {
     *                 "id_obat": 1,
     *                 "jumlah": 2,
     *                 "aturan_pakai": "3x sehari"
     *             }
     *         ]
     *     }
     * ]
     */
    public function index()
    {
        $reseps = EResep::with('details')->get();
        return response()->json($reseps);
    }

    /**
     * @OA\Post(
     *     path="/api/e-resep",
     *     summary="Tambah resep baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="no_registrasi", type="string", example="12345")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Resep yang baru dibuat")
     * )
     */
    /**
     * Tambah resep baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @group EResep
     * @bodyParam no_registrasi string required Nomor registrasi pasien. Example: 12345
     * @response 201 {
     *     "id": 1,
     *     "no_registrasi": "12345",
     *     "details": []
     * }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'no_registrasi' => 'required|string',
            // … kolom lain jika ada
        ]);

        $resep = EResep::create($data);
        $resep->load('details');

        return response()->json($resep, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/e-resep/{e_resep}",
     *     summary="Ambil satu resep beserta detailnya",
     *     @OA\Parameter(name="e_resep", in="path", required=true, description="ID Resep"),
     *     @OA\Response(response=200, description="Resep")
     * )
     */
    /**
     * Ambil satu resep beserta detailnya.
     *
     * @param \App\Models\EResep $e_resep
     * @return \Illuminate\Http\JsonResponse
     * @group EResep
     * @response 200 {
     *     "id": 1,
     *     "no_registrasi": "12345",
     *     "details": [
     *         {
     *             "id_obat": 1,
     *             "jumlah": 2,
     *             "aturan_pakai": "3x sehari"
     *         }
     *     ]
     * }
     */
    public function show(EResep $e_resep)
    {
        $e_resep->load('details');
        return response()->json($e_resep);
    }

    /**
     * @OA\Put(
     *     path="/api/e-resep/{e_resep}",
     *     summary="Update data resep",
     *     @OA\Parameter(name="e_resep", in="path", required=true, description="ID Resep"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="no_registrasi", type="string", example="12345")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Resep yang sudah diupdate")
     * )
     */
    /**
     * Update data resep.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EResep $e_resep
     * @return \Illuminate\Http\JsonResponse
     * @group EResep
     * @bodyParam no_registrasi string Nomor registrasi pasien. Example: 12345
     * @response 200 {
     *     "id": 1,
     *     "no_registrasi": "12345",
     *     "details": []
     * }
     */
    public function update(Request $request, EResep $e_resep)
    {
        $data = $request->validate([
            'no_registrasi' => 'sometimes|required|string',
            // … kolom lain jika ada
        ]);

        $e_resep->update($data);
        $e_resep->load('details');

        return response()->json($e_resep);
    }

    /**
     * @OA\Delete(
     *     path="/api/e-resep/{e_resep}",
     *     summary="Hapus resep tertentu",
     *     @OA\Parameter(name="e_resep", in="path", required=true, description="ID Resep"),
     *     @OA\Response(response=204, description="No Content")
     * )
     */
    /**
     * Hapus resep tertentu.
     *
     * @param \App\Models\EResep $e_resep
     * @return \Illuminate\Http\JsonResponse
     * @group EResep
     * @response 204 {}
     */
    public function destroy(EResep $e_resep)
    {
        $e_resep->delete();
        return response()->json(null, 204);
    }
}