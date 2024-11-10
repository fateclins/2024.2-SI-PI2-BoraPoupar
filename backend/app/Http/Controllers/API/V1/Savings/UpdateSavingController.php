<?php

namespace App\Http\Controllers\API\V1\Savings;

use App\Http\Controllers\Controller;
use App\Models\Saving;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateSavingController extends Controller
{
    public function __invoke(Request $request, Saving $saving): JsonResponse
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $saving->update($data);

        return response()->json([
            'message' => 'Saving updated successfully',
        ], 200);
    }
}
