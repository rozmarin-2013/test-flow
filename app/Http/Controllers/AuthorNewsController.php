<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\Author;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Attributes as OA;

class AuthorNewsController extends Controller
{
    #[OA\Get(
        path: '/api/author/{author}/news',
        description: 'Get all articles for given author',
        parameters: [
            new OA\Parameter(
                name: "author",
                example: '1',
                in: "path"
            )
        ],
        responses: [
            new OA\Response(
                response: 404,
                description: 'Not found author',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: "error",
                            type: "string",
                            example: "No query results for model [App\\Models\\Author] 1000"
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 200,
                description: 'Get all articles for given author.',
                content: new OA\JsonContent(
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
                                        example: "title"
                                    ),
                                    new OA\Property(
                                        property: "text",
                                        type: "text",
                                        example: "text"
                                    )
                                ]
                            )
                        ),
                        new OA\Property(
                            property: "links",
                            type: "object",
                            properties: [
                                new OA\Property(
                                    property: "first",
                                    type: "string",
                                    example: "http://localhost:8989/api/author/1/news?page=1"
                                ),
                                new OA\Property(
                                    property: "last",
                                    type: "string",
                                    example: "http://localhost:8989/api/author/1/news?page=1"
                                ),
                                new OA\Property(
                                    property: "prev",
                                    type: "integer",
                                    example: null
                                ),
                                new OA\Property(
                                    property: "next",
                                    type: "integer",
                                    example: null
                                ),
                            ]
                        ),
                        new OA\Property(
                            property: "meta",
                            type: "object",
                            properties: [
                                new OA\Property(
                                    property: "current_page",
                                    type: "integer",
                                    example: 1
                                ),
                                new OA\Property(
                                    property: "from",
                                    type: "integer",
                                    example: null
                                ),
                                new OA\Property(
                                    property: "last_page",
                                    type: "integer",
                                    example: 5
                                ),
                                new OA\Property(
                                    property: "links",
                                    type: "array",
                                    items: new OA\Items(
                                        type: 'object',
                                        properties: [
                                            new OA\Property(
                                                property: "url",
                                                type: "string",
                                                example: null
                                            ),
                                            new OA\Property(
                                                property: "active",
                                                type: "boolean",
                                                example: false
                                            ),
                                            new OA\Property(
                                                property: "label",
                                                type: "string",
                                                example: "Next &raquo;",
                                            ),
                                        ]
                                    )
                                ),
                            ]
                        ),
                        ],
                    type: 'object'
                )
            )
        ]
    )]
    public function show(Author $author): AnonymousResourceCollection
    {
        return NewsResource::collection($author->news()->paginate());
    }
}
