<?php

namespace App\Service;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AuthorTopService
{
    public function top(): Collection
    {
        return Author::has('news')->withCount(['news' => function (Builder $query) {
            $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
        }])->orderBy('news_count', 'DESC')->limit(3)->get();
    }
}
