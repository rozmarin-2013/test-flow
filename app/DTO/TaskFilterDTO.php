<?php

namespace App\DTO;

use Carbon\Carbon;

class TaskFilterDTO
{
    public readonly ?string $createdAtStart;
    public readonly ?string $createdAtEnd;
    public function __construct(
        public readonly ?string $status,
        public ?string $createdAt = null
    )
    {
        $this->createdAtStart = ($createdAt) ? Carbon::parse($createdAt)->startOfDay() : null;
        $this->createdAtEnd = ($createdAt) ? Carbon::parse($createdAt)->endOfDay() : null;
    }
}
