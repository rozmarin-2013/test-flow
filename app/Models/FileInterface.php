<?php

namespace App\Models;

interface FileInterface
{
    public static function getWidth(): float;
    public static function getHeight(): float;

    public static function getStorage(): string;
}
