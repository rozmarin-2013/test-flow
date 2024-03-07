<?php

namespace App\Enum;

enum TaskStatus: int
{
    case NOT_ACTIVE = 0;
    case ACTIVE = 1;
    case CLOSE = 2;
}
