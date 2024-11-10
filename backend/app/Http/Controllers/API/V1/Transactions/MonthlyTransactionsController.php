<?php

namespace App\Http\Controllers\API\V1\Transactions;

use App\Http\Controllers\Controller;
use App\MOdels\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonthlyTransactionsController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $month = now()->month;

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $incomes = Transaction::where('type', 'income')
            ->where('user_id', $user->id)
            ->whereMonth('created_at', $month)
            ->sum('amount');

        $expenses = Transaction::where('type', 'expense')
            ->where('user_id', $user->id)
            ->whereMonth('created_at', $month)
            ->sum('amount');

        return response()->json([
            'incomes' => $incomes,
            'expenses' => $expenses,
        ], 200);
    }
}
