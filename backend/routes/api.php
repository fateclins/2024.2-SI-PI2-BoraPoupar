<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    require_once __DIR__ . '/api/v1/auth.php';
    require_once __DIR__ . '/api/v1/transactions.php';
    require_once __DIR__ . '/api/v1/savings.php';
});
