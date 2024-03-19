<?php

namespace App\Http\Controllers\Good;

use App\Http\Controllers\Controller;
use App\Http\Resources\GoodResource;
use App\Models\Good;
use Illuminate\Http\Request;
use Ramsey\Collection\Sort;

class GoodController extends Controller
{
    public function __invoke(Request $request)
    {
        $sort = $request->enum('sort.price', Sort::class);

        return GoodResource::collection(
            Good::query()->orderBy('price', $sort?->value ?? 'asc'
            )->paginate()
        );
    }
}
