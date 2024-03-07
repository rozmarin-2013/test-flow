<?php

namespace App\Models;

use App\Enum\TaskStatus;
use App\Trait\FilterableByDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, FilterableByDates;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => TaskStatus::class
    ];
}
