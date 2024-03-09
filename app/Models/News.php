<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $table = 'news';

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'author_news', 'news_id');
    }
}
