<?php

namespace App\Http\Controllers\API\V1\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowTransactionController extends Controller
{
    public function __invoke(Request $request, Transaction $transaction): JsonResponse
    {
        return response()->json($transaction, 200);
    }
}
