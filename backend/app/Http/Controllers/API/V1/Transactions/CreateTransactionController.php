<?php

namespace App\Http\Controllers\API\V1\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Transactions\CreateTransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CreateTransactionController extends Controller
{
    public function __invoke(CreateTransactionRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $transaction = Transaction::create($data);

            /** @var \App\Models\User $user */
            $user = Auth::user();

            if ($transaction->type === 'expense') {
                $user->balance -= $transaction->amount;
                $user->save();

                return response()->json($transaction, 201);
            }

            $user->balance += $transaction->amount;

            $user->save();

            return response()->json($transaction, 201);
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
