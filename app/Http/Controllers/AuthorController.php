<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorTopResource;
use App\Service\AuthorTopService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Attributes as OA;

class AuthorController extends Controller
{
    public function __construct(private readonly AuthorTopService $authorTopService)
    {
    }

    #[OA\Get(
        path: '/api/author/top',
        description: 'Get all articles for given author',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Get all articles for given author',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: "data",
                            type: "array",
                            items: new OA\Items(
                                type: 'object',
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: "1"
                                    ),
                                    new OA\Property(
                                        property: "name",
                                        type: "string",
                                        example: "name"
                                    ),
                                    new OA\Property(
                                        property: "news_count",
                                        type: "integer",
                                        example: "10"
                                    )
                                ]
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function top(): AnonymousResourceCollection
    {
        return AuthorTopResource::collection($this->authorTopService->top());
    }
}
