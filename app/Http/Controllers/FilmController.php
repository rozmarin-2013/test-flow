<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmStoreRequest;
use App\Http\Requests\FilmUpdateRequest;
use App\Http\Resources\FilmResource;
use App\Http\Services\FilmService;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FilmController extends Controller
{

    public function __construct(private readonly FilmService $filmService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $films = $this->filmService->filter($request) ?? Film::paginate();

        return FilmResource::collection($films);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmStoreRequest $request)
    {
        $film = $this->filmService->store($request);

        return response(new FilmResource($film), Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film): FilmResource
    {
        return new FilmResource($film);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilmUpdateRequest $request, Film $film)
    {
        $this->filmService->update($film, $request);

        return response(new FilmResource($film), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $this->filmService->delete($film);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
