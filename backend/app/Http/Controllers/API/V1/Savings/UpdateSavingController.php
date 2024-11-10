<?php

namespace App\Http\Controllers\API\V1\Savings;

use App\Http\Controllers\Controller;
use App\Models\Saving;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateSavingController extends Controller
{
    public function __invoke(Request $request, Saving $saving): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user) {
            return response()->json([
                'message' => 'User is not verified',
            ], 401);
        }

        if ($saving->user_id !== $user->id) {
            return response()->json([
                'message' => 'Forbidden',
            ], 403);
        }

        $data = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $saving->update($data);

        return response()->json([
            'message' => 'Saving updated successfully',
        ], 200);
    }
}
