<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class SiteSettingDocumentation
{
    #[OA\Get(
        path: '/admin/site-settings',
        tags: ['Site Settings'],
        security: [['sanctum' => []]],
        summary: 'Get site settings',
        responses: [
            new OA\Response(response: 200, description: 'Settings retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Patch(
        path: '/admin/site-settings',
        tags: ['Site Settings'],
        security: [['sanctum' => []]],
        summary: 'Update site settings',
        responses: [
            new OA\Response(response: 200, description: 'Settings updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(): void
    {
    }
}
