<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use OpenApi\Attributes as OA;


#[
    OA\Info(version: "1.0.0", description: "news api", title: "News Documentation"),
    OA\Server(url: 'http://localhost:8989', description: "local server"),
]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
