<?php

namespace App\Http\Controllers\API\V1\Savings;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListSavingController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $savings = $user->savings()
            ->select('id', 'name', 'amount', 'goal', 'description', 'created_at')
            ->get();

        return response()->json($savings, 200);
    }
}
