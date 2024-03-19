<?php

namespace App\Http\Controllers\Balance;

use App\Http\Controllers\Controller;
use App\Http\Requests\BalanceRequest;
use App\Services\BalanceService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function __construct(protected BalanceService $balanceService)
    {
    }

    public function add(BalanceRequest $request)
    {
        $user = Auth::user();
        $this->balanceService->add($user, $request->json('sum'));

        return response(null, Response::HTTP_OK);
    }
}
