<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class PermissionDocumentation
{
    #[OA\Get(
        path: '/admin/permissions',
        tags: ['Permissions'],
        security: [['sanctum' => []]],
        summary: 'Get permissions',
        responses: [
            new OA\Response(response: 200, description: 'Permissions retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Get(
        path: '/admin/permissions/{id}',
        tags: ['Permissions'],
        security: [['sanctum' => []]],
        summary: 'Get permission details',
        responses: [
            new OA\Response(response: 200, description: 'Permission retrieved successfully'),
            new OA\Response(response: 404, description: 'Permission not found')
        ]
    )]
    public function show(): void
    {
    }
}
