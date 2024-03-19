<?php

namespace App\Services;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(private readonly BalanceService $balanceService)
    {

    }

    /**
     * @throws \Exception
     */
    public function create(User $user): void
    {
        /** @var Basket $bakset */
        $bakset = $user->basket;

        if (!$bakset) {
            throw new \Exception("You don't have any good in the basket" );
        }

        if ($user->balance < $bakset->sum) {
            throw new \Exception("You don't have enough money");
        }

        try {
            DB::beginTransaction();

            $order = new Order();
            $order->sum = $bakset->sum;
            $user->orders()->save($order);

            /** @var BasketItem $item */
            foreach ($bakset->items()->get() as $item) {
                $orderItem = new OrderItem();
                $orderItem->count = $item->count;
                $orderItem->sum = $item->sum;
                $orderItem->good()->associate($item->good);
                $orderItem->order()->associate($order);
                $orderItem->save();
            }

            $this->balanceService->minus($user, $bakset->sum);
            $bakset->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * @throws \Exception
     */
    public function delete(Order $order, User $user): void
    {
        try {
            DB::beginTransaction();

            $this->balanceService->add($user, $order->sum);
            $order->delete();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
