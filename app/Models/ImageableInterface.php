<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface ImageableInterface
{
    public function image():MorphOne;
}
