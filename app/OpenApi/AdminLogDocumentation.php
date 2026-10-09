<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class AdminLogDocumentation
{
    #[OA\Get(
        path: '/admin/admin-logs',
        tags: ['Admin Logs'],
        security: [['sanctum' => []]],
        summary: 'Get admin logs',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Admin logs retrieved successfully'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
            )
        ]
    )]
    public function index(): void {}

    #[OA\Get(
        path: '/admin/admin-logs/{id}',
        tags: ['Admin Logs'],
        security: [['sanctum' => []]],
        summary: 'Get admin log details',
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Admin log retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Not found'
            )
        ]
    )]
    public function show(): void {}
}
