<?php

namespace App\Http\Controllers\API\V1\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoriesListController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $type = $request->query('type');

        $categories = Category::select('id', 'name', 'type')
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->get();

            ds($categories);

        return response()->json($categories, 200);
    }
}
