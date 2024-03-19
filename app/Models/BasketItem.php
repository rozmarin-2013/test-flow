<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BasketItem extends Model
{
    use HasFactory;

    protected $table = 'basket_item';

    public function basket(): BelongsTo
    {
        return $this->belongsTo(Basket::class);
    }

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }
}
