<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use OpenApi\Attributes as OA;

class NewsController extends Controller
{
    #[OA\Get(
        path: '/api/news/{news}',
        description: 'Get article by some id',
        parameters: [
            new OA\Parameter(
                name: "news",
                example: '1',
                in: "path"
            )
        ],
        responses: [
            new OA\Response(
                response: 404,
                description: 'Not found article by some id',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: "error",
                            type: "string",
                            example: "No query results for model [App\\Models\\News] 100"
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 200,
                description: 'Get article by some id',
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
                                        property: "title",
                                        type: "string",
                                        example: "name"
                                    ),
                                    new OA\Property(
                                        property: "text",
                                        type: "text",
                                        example: "text"
                                    ),
                                    new OA\Property(
                                        property: "created_at",
                                        type: "string",
                                        example: "2024-02-10T06:01:15.000000Z"
                                    )
                                ]
                            )
                        )
                    ]
                )
            )
        ]
    )]
    public function show(News $news): NewsResource
    {
        return new NewsResource($news);
    }
}
