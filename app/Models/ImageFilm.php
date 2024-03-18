<?php

namespace App\Models;

use App\Models\FileInterface;
use App\Models\Image;

class ImageFilm extends Image implements FileInterface
{

    private static float $width = 100;

    private static float $height = 100;

    private static string $storage = 'images';

    public static function getWidth(): float
    {
        return self::$width;
    }

    public static function getHeight(): float
    {
        return self::$height;
    }

    public static function getStorage(): string
    {
        return self::$storage;
    }
}
