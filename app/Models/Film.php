<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Film extends Model implements ImageableInterface
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'country'];


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'film_category');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(ImageFilm::class, 'imageable');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(CommentFilm::class);
    }
}
