<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
/**
 * @hideFromApiDocs
 * DEBUG: Jangan tampilkan ini
 */
    public function index()
    {
        $dokters = Dokter::all();
        return response()->json($dokters);    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|integer|exists:users,id_user',
            'nama_dokter' => 'required|string',
            'no_hp_dokter' => 'required|string',
            'spesialis' => 'required|string',
        ]);

        $dokter = Dokter::create($data);
        return response()->json($dokter, 201);    }

    public function show(Dokter $dokter)
    {
        return response()->json($dokter);    }

    public function update(Request $request, Dokter $dokter)
    {
        $data = $request->validate([
            'id_user' => 'required|integer|exists:users,id_user',
            'nama_dokter' => 'required|string',
            'no_hp_dokter' => 'required|string',
            'spesialis' => 'required|string',
        ]);

        $dokter->update($data);
        return response()->json($dokter);    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return response()->json(null, 204);
    }
}
