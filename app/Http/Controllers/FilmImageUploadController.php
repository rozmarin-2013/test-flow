<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUpload;
use App\Http\Services\ImageService;
use App\Models\Film;
use App\Models\ImageFilm;

class FilmImageUploadController extends Controller
{

    public function __construct(private readonly ImageService $imageService)
    {
    }

    public function __invoke(Film $film, ImageUpload $imageUpload): array
    {
        $this->imageService->deleteImage($film);

        $file = $imageUpload->file('image');

        $image = $this->imageService->uploadResize(
            $file,
            $film,
            new ImageFilm()
        );

        return ['url' => stripcslashes(env('APP_URL') . '/' . $image->url)];
    }
}
