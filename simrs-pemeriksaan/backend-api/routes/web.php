<?php

use Illuminate\Support\Facades\Route;

// Explicit CSRF cookie route
Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['message' => 'CSRF cookie set']);
})->middleware(['web']);

Route::get('/', function () {
    return view('page');
});