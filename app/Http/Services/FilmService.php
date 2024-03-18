<?php

namespace App\Http\Services;

use App\Http\Requests\FilmStoreRequest;
use App\Http\Requests\FilmUpdateRequest;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FilmService
{

    public function __construct(private readonly ImageService $imageService)
    {
    }
    public function filter(Request $request): ?LengthAwarePaginator
    {
        return ($request->title)
            ? Film::where('title','LIKE',"%{$request->title}%")->paginate()
            : null;
    }

    public function store(FilmStoreRequest $request): Film
    {
        $film =new Film();

        $film->title = $request->title;
        $film->description = $request->description;
        $film->country = $request->country;
        $film->save();

        $film->categories()->attach($request->category_ids);

        return $film;
    }

    public function update(Film $film, FilmUpdateRequest $request): void
    {
        $film->update($request->only('title', 'country', 'description'));

        if ($request->category_ids) {
            $film->categories()->sync($request->category_ids);
        }
    }

    public function delete(Film $film): void
    {
        $this->imageService->deleteImage($film);
        $film->categories()->detach();
        $film->delete();
    }
}
