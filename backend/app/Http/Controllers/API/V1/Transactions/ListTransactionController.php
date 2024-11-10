<?php

namespace App\Http\Controllers\API\V1\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListTransactionController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->select('id', 'name', 'amount', 'type', 'note', 'category_id', 'created_at')
            ->with([
                'category' => function ($query) {
                    $query->select('id', 'name', 'type');
                },
            ])
            ->get()
            ->map(function ($transaction) {
                $transaction->created_at_human = Carbon::parse($transaction->created_at)->diffForHumans();

                return $transaction;
            });

        return response()->json($transactions, 200);
    }
}
