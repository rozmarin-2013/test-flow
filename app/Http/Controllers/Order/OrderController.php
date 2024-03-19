<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {

    }

    /**
     * @throws \Exception
     */
    public function create()
    {
        $this->orderService->create(Auth::user());

        return response(null, Response::HTTP_OK);
    }

    public function delete(Order $order)
    {
        $this->orderService->delete($order, Auth::user());

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
