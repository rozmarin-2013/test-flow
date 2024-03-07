<?php

namespace App\Services;

use App\DTO\TaskFilterDTO;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;

class TaskService
{
    public function filter(TaskFilterDTO $taskFilterDTO): Builder
    {
        $query = Task::query();

        if ($taskFilterDTO->status !== null) {
            $query->where('status', '=', $taskFilterDTO->status);
        }

        if ($taskFilterDTO->createdAtStart && $taskFilterDTO->createdAtEnd) {
            $query->whereDateBetween( $taskFilterDTO->createdAtStart, $taskFilterDTO->createdAtEnd);
        }

        return $query;
    }
}
