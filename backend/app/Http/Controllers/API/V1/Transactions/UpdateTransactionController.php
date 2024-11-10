<?php

namespace App\Http\Controllers\API\V1\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Transactions\UpdateTransactionRequest;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateTransactionController extends Controller
{
    public function __invoke(UpdateTransactionRequest $request, Transaction $transaction): JsonResponse
    {
        try {
            $data = $request->validated();

            $old_amount = $transaction->amount;

            $transaction->update($data);

            /** @var \App\Models\User $user */
            $user = Auth::user();

            if ($transaction->type === 'expense') {
                $user->balance += $old_amount - $transaction->amount;

                $user->save();

                return response()->json($transaction, 200);
            }

            $user->balance += $transaction->amount - $old_amount;

            $user->save();

            return response()->json($transaction, 200);

        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
