<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class AboutUsDocumentation
{
    #[OA\Get(
        path: '/admin/about-us',
        tags: ['About Us'],
        security: [['sanctum' => []]],
        summary: 'Get about us information',
        responses: [
            new OA\Response(
                response: 200,
                description: 'About us retrieved successfully'
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


    #[OA\Patch(
        path: '/admin/about-us',
        tags: ['About Us'],
        security: [['sanctum' => []]],
        summary: 'Update about us information',
        responses: [
            new OA\Response(
                response: 200,
                description: 'About us updated successfully'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
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
}
