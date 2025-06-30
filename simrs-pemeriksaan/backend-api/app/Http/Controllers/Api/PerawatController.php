<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat;

/**
 * @hideFromApiDocs
 * DEBUG: Jangan tampilkan ini
 */
class PerawatController extends Controller
{
    public function index()
    {
        $perawats = Perawat::all();
        return response()->json($perawats);
    }

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

    public function show(Perawat $perawat)
    {
        return response()->json($perawat);
    }

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

    public function destroy(Perawat $perawat)
    {
        $perawat->delete();
        return response()->json(null, 204);
    }
}
