<?php

use App\Http\Controllers\API\V1\Savings\CreateSavingController;
use App\Http\Controllers\API\V1\Savings\DeleteSavingController;
use App\Http\Controllers\API\V1\Savings\ListSavingController;
use Illuminate\Support\Facades\Route;

Route::prefix('savings')->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/', ListSavingController::class);
        Route::post('/', CreateSavingController::class);

        Route::delete('/{saving}', DeleteSavingController::class);

        
        // Route::get('/{saving}', ShowSavingController::class);
        // Route::put('/{saving}', UpdateSavingController::class);
        // Route::delete('/{saving}', DeleteSavingController::class);

    });
