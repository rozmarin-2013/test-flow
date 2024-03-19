<?php

namespace App\Services;

use App\DTO\TaskFilterDTO;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class BalanceService
{
    public function add(User $user, float $sum)
    {
        $user->balance += $sum;
        $user->save();
    }

    public function minus(User $user, float $sum)
    {
        $user->balance -= $sum;
        $user->save();
    }
}
