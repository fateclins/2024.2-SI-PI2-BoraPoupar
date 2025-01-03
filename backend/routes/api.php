<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')
    ->name('api.v1.')
    ->group(function () {
        Route::get('/ping', function () {
            return response()->json(['message' => 'pong']);
        });

        require __DIR__.'/api/v1/auth.php';
        require __DIR__.'/api/v1/transactions.php';
        require __DIR__.'/api/v1/savings.php';
    });
