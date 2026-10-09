<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class NewsDocumentation
{
    #[OA\Get(
        path: '/admin/news',
        tags: ['News'],
        security: [['sanctum' => []]],
        summary: 'Get news',
        responses: [
            new OA\Response(
                response: 200,
                description: 'News retrieved successfully'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
            )
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Post(
        path: '/admin/news',
        tags: ['News'],
        security: [['sanctum' => []]],
        summary: 'Create news',
        responses: [
            new OA\Response(
                response: 201,
                description: 'News created successfully'
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error'
            )
        ]
    )]
    public function store(): void
    {
    }


    #[OA\Get(
        path: '/admin/news/{id}',
        tags: ['News'],
        security: [['sanctum' => []]],
        summary: 'Get news details',
        responses: [
            new OA\Response(
                response: 200,
                description: 'News retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'News not found'
            )
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/news/{id}',
        tags: ['News'],
        security: [['sanctum' => []]],
        summary: 'Update news',
        responses: [
            new OA\Response(
                response: 200,
                description: 'News updated successfully'
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error'
            )
        ]
    )]
    public function update(): void
    {
    }


    #[OA\Delete(
        path: '/admin/news/{id}',
        tags: ['News'],
        security: [['sanctum' => []]],
        summary: 'Delete news',
        responses: [
            new OA\Response(
                response: 200,
                description: 'News deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'News not found'
            )
        ]
    )]
    public function destroy(): void
    {
    }
}
