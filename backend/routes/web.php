<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/server', function () {
    ds('Server: ' . gethostname());
    return response()->json(['server' => gethostname()]);
});