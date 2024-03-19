<?php

namespace App\Services;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Good;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BasketService
{
    /**
     * @throws \Exception
     */
    public function add(User $user, Good $good, int $count): void
    {
        try {
            DB::beginTransaction();

            $basket = $user->basket ?? new Basket();
            $basketItem = $basket->items()->where('good_id', $good->id)->first() ?? new BasketItem();

            $sum = $good->price * $count;
            $basketItem->sum += $sum;
            $basket->sum += $sum;

            $user->basket()->save($basket);


            $basketItem->count += $count;
            $basketItem->good()->associate($good);
            $basketItem->basket()->associate($basket);

            $basketItem->save();


            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * @throws \Exception
     */
    public function delete(User $user, Good $good): void
    {
        $basket = $user->basket;

        if (!$basket) {
            throw new \Exception('Basket is Empty');
        }

        /** @var BasketItem $basketItem */
        $basketItem = $basket->items()->where('good_id', $good->id)->first();

        if (!$basketItem) {
            throw new \Exception(sprintf('Basket item with goodId %d not found', $good->id));
        }

        $basketItem->delete();

        if (!$basket->items()->count()) {
            $basket->delete();
        }
    }
}
