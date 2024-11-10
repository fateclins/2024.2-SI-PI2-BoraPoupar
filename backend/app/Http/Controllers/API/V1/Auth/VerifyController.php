<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user) {
            return response()->json([
                'message' => 'User is verified',
            'user' => $user->only('id', 'name', 'email', 'balance'),
            ]);
        }
    }
}
