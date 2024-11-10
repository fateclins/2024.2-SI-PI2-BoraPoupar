<?php

namespace App\Http\Controllers\API\V1\Savings;

use App\Http\Controllers\Controller;
use App\Models\Saving;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteSavingController extends Controller
{
    public function __invoke(Request $request, Saving $saving): JsonResponse
    {
        $saving->delete();

        return response()->json([
            'message' => 'Saving deleted successfully'
        ], 200);
    }
}
