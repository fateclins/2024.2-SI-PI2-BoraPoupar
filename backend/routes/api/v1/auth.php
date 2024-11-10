<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\Auth\VerifyController;
use App\Http\Controllers\API\V1\Auth\LoginController;

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);

    Route::get('verify', VerifyController::class)->middleware('auth:sanctum');
});
