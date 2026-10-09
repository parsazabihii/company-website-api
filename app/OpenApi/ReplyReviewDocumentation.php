<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class ReplyReviewDocumentation
{
    #[OA\Get(
        path: '/admin/reply-reviews',
        tags: ['Reply Reviews'],
        security: [['sanctum' => []]],
        summary: 'Get reply reviews',
        responses: [
            new OA\Response(response: 200, description: 'Replies retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Post(
        path: '/admin/reply-reviews',
        tags: ['Reply Reviews'],
        security: [['sanctum' => []]],
        summary: 'Create reply review',
        responses: [
            new OA\Response(response: 201, description: 'Reply created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(): void
    {
    }


    #[OA\Delete(
        path: '/admin/reply-reviews/{id}',
        tags: ['Reply Reviews'],
        security: [['sanctum' => []]],
        summary: 'Delete reply review',
        responses: [
            new OA\Response(response: 200, description: 'Reply deleted successfully'),
            new OA\Response(response: 404, description: 'Not found')
        ]
    )]
    public function destroy(): void
    {
    }
}
