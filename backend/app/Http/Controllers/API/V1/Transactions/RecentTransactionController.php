<?php

namespace App\Http\Controllers\API\V1\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class RecentTransactionController extends Controller
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
                }
            ])
            ->get()
            ->map(function ($transaction) {
                $transaction->created_at_human = Carbon::parse($transaction->created_at)->diffForHumans();
                return $transaction;
            })
            ->take(5);

        return response()->json($transactions, 200);
    }
}
