<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Perawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
/**
 * @hideFromApiDocs
 * DEBUG: Jangan tampilkan ini
 */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah'
            ], 401);
        }

        // Generate Sanctum token
        $token = $user->createToken('auth-token')->plainTextToken;

        // Get additional info based on role
        $additionalInfo = null;
        $poliInfo = null;
        if ($user->role === 'DOKTER') {
            $additionalInfo = Dokter::where('id_user', $user->id_user)->first();
            if ($additionalInfo) {
                $poliInfo = \App\Models\Poli::where('id_dokter', $additionalInfo->id_dokter)->first();
            }
        } else if ($user->role === 'PERAWAT') {
            $additionalInfo = Perawat::where('id_user', $user->id_user)->first();
            if ($additionalInfo) {
                $poliInfo = \App\Models\Poli::where('id_perawat', $additionalInfo->id_perawat)->first();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user' => $user,
                'additional_info' => $additionalInfo,
                'poli' => $poliInfo,
                'token' => $token
            ]
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }
} 