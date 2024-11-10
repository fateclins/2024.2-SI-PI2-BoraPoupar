<?php

use App\Http\Controllers\API\V1\Transactions\CategoriesListController;
use App\Http\Controllers\API\V1\Transactions\CreateTransactionController;
use App\Http\Controllers\API\V1\Transactions\DeleteTransactionController;
use App\Http\Controllers\API\V1\Transactions\ListTransactionController;
use App\Http\Controllers\API\V1\Transactions\MonthlyTransactionsController;
use App\Http\Controllers\API\V1\Transactions\RecentTransactionController;
use App\Http\Controllers\API\V1\Transactions\ShowTransactionController;
use App\Http\Controllers\API\V1\Transactions\UpdateTransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('transactions')->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/categories', CategoriesListController::class);
        Route::get('/recent', RecentTransactionController::class);
        Route::get('/monthly', MonthlyTransactionsController::class);

        Route::get('/', ListTransactionController::class);
        Route::post('/', CreateTransactionController::class);

        Route::get('/{transaction}', ShowTransactionController::class);
        Route::put('/{transaction}', UpdateTransactionController::class);
        Route::delete('/{transaction}', DeleteTransactionController::class);
    });
