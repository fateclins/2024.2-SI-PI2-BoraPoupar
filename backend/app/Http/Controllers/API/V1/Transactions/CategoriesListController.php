<?php

namespace App\Http\Controllers\API\V1\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoriesListController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $type = $request->query('type');

        $categories = Cache::remember("categories_{$type}", 60, function () use ($type) {
            return Category::select('id', 'name', 'type')
                ->when($type, function ($query, $type) {
                    return $query->where('type', $type);
                })
                ->get();
        });

        return response()->json($categories, 200);
    }
}
