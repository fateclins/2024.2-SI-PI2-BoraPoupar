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

Route::prefix('transactions')
    ->name('transactions.')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/categories', CategoriesListController::class)->name('categories');
        Route::get('/recent', RecentTransactionController::class)->name('recent');
        Route::get('/monthly', MonthlyTransactionsController::class)->name('monthly');

        Route::get('/', ListTransactionController::class)->name('list');
        Route::post('/', CreateTransactionController::class)->name('create');

        Route::get('/{transaction}', ShowTransactionController::class)->name('show');
        Route::put('/{transaction}', UpdateTransactionController::class)->name('update');
        Route::delete('/{transaction}', DeleteTransactionController::class)->name('delete');
    });
