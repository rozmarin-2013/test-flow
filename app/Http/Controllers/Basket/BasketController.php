<?php

namespace App\Http\Controllers\Basket;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketRequest;
use App\Models\Basket;
use App\Models\Good;
use App\Services\BasketService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function __construct(private readonly BasketService $basketService)
    {

    }
    public function add(BasketRequest $request)
    {
        $this->basketService->add(
            Auth::user(),
            Good::find($request->request->get('good_id')),
            $request->request->get('count')
        );

        return response(null, Response::HTTP_OK);
    }

    public function delete(Good $good)
    {
        $this->basketService->delete(Auth::user(), $good);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
