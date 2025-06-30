<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    public function handle(Request $request, Closure $next)
    {
        $allowedOrigins = [
            'http://localhost:5173',
            'https://simrs-pemeriksaan.netlify.app',
            'https://frontend-pemeriksaan.vercel.app',
            'https://ti054a02.agussbn.my.id'
        ];

        $origin = $request->header('Origin');
        $allowedOrigin = in_array($origin, $allowedOrigins) ? $origin : null;

        // Handle preflight OPTIONS request
        if ($request->isMethod('OPTIONS')) {
            return response('', 200)
                ->header('Access-Control-Allow-Origin', $allowedOrigin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-XSRF-TOKEN, X-CSRF-TOKEN')
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Max-Age', '86400');
        }

        $response = $next($request);

        return $response
            ->header('Access-Control-Allow-Origin', $allowedOrigin)
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-XSRF-TOKEN, X-CSRF-TOKEN')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}