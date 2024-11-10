<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\Auth\VerifyController;

Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::post('register', RegisterController::class)->name('register');
        Route::post('login', LoginController::class)->name('login');

        Route::get('verify', VerifyController::class)->middleware('auth:sanctum')->name('verify');
    });
