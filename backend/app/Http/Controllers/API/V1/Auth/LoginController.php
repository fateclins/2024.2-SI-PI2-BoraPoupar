<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (! $request->has('email') || ! $request->has('password')) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
            ], 422);
        }

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        return response()->json([
            'message' => 'Login success',
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user->only('id', 'name', 'email', 'balance'),
        ]);
    }
}
