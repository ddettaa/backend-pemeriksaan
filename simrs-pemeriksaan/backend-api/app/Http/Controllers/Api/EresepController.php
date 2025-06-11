<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EResep;
use Illuminate\Http\Request;

class EResepController extends Controller
{
    /**
     * Tampilkan daftar resep dengan pagination
     */
    public function index()
    {
        $reseps = EResep::with('details')->get();
        return response()->json($reseps);
    }

    /**
     * Simpan resep baru
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
     * Tampilkan satu resep beserta detailnya
     */
    public function show(EResep $e_resep)
    {
        $e_resep->load('details');
        return response()->json($e_resep);
    }

    /**
     * Update data resep
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
     * Hapus resep
     */
    public function destroy(EResep $e_resep)
    {
        $e_resep->delete();
        return response()->json(null, 204);
    }
}