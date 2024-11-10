<?php

use App\Http\Controllers\API\V1\Transactions\CategoriesListController;
use Illuminate\Support\Facades\Route;

Route::prefix('transactions')->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/categories', CategoriesListController::class);
    });
