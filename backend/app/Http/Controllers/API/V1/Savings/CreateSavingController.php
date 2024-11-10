<?php

namespace App\Http\Controllers\API\V1\Savings;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Savings\CreateSavingRequest;
use Illuminate\Http\JsonResponse;

class CreateSavingController extends Controller
{
    public function __invoke(CreateSavingRequest $request): JsonResponse
    {
        $data = $request->validated();

        /** @var \App\Models\User $user */
        $user = $request->user();

        $saving = $user->savings()->create($data);

        return response()->json($saving, 201);
    }
}
