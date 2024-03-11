<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'author_news', 'author_id');
    }
}
