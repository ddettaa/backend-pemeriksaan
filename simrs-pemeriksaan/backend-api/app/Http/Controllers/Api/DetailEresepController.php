<?php
// app/Http/Controllers/Api/DetailEResepController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EResep;
use App\Models\DetailEResep;
use Illuminate\Http\Request;

class DetailEResepController extends Controller
{
    /**
     * Tampilkan daftar detail resep dengan pagination
     */
    public function index(EResep $e_resep)
    {
        $details = $e_resep->details()->get();
        return response()->json($details);
    }

    /**
     * Simpan detail resep baru
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
     * Tampilkan satu detail resep
     */
    public function show(EResep $e_resep, DetailEResep $detail_e_resep)
    {
        return response()->json($detail_e_resep);
    }

    /**
     * Update detail resep
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
     * Hapus detail resep
     */
    public function destroy(EResep $e_resep, DetailEResep $detail_e_resep)
    {
        $detail_e_resep->delete();
        return response()->json(null, 204);
    }
}
