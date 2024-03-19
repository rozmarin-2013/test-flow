<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Good extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price'
    ];

    public function basketItems(): HasMany
    {
        return $this->hasMany(BasketItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
