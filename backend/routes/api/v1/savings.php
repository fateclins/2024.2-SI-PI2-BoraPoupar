<?php

use App\Http\Controllers\API\V1\Savings\CreateSavingController;
use App\Http\Controllers\API\V1\Savings\DeleteSavingController;
use App\Http\Controllers\API\V1\Savings\ListSavingController;
use App\Http\Controllers\API\V1\Savings\UpdateSavingController;
use Illuminate\Support\Facades\Route;

Route::prefix('savings')
    ->name('savings.')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/', ListSavingController::class)->name('list');
        Route::post('/', CreateSavingController::class)->name('create');

        Route::delete('/{saving}', DeleteSavingController::class)->name('delete');

        Route::put('/{saving}', UpdateSavingController::class)->name('update');
    });
