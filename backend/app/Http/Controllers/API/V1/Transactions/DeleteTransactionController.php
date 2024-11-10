<?php

namespace App\Http\Controllers\API\V1\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteTransactionController extends Controller
{
    public function __invoke(Request $request, Transaction $transaction): JsonResponse
    {
        if ($transaction->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'You are not authorized to delete this transaction',
            ], 403);
        }

        $amount = $transaction->amount;

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($transaction->type === 'expense') {
            $user->balance += $amount;
        } else {
            $user->balance -= $amount;
        }

        $transaction->delete();
        $user->save();

        return response()->json([
            'message' => 'Transaction deleted successfully',
        ], 200);
    }
}
