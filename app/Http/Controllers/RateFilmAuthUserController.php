<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmCommentCreateRequest;
use App\Http\Resources\CommentResource;
use App\Models\CommentFilm;
use App\Models\Film;
use Illuminate\Http\Response;

class RateFilmAuthUserController extends Controller
{
    public function __invoke(Film $film, FilmCommentCreateRequest $request)
    {
        $user = auth()->user();

        $comment = new CommentFilm();
        $comment->text = $request->text;
        $comment->rate = $request->rate;
        $comment->user()->associate($user);
        $comment->film()->associate($film);
        $comment->save();

        return response(new CommentResource($comment), Response::HTTP_CREATED);
    }
}

