<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page');
});

require __DIR__.'/auth.php';
