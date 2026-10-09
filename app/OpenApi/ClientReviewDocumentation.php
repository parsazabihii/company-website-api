<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class ClientReviewDocumentation
{
    #[OA\Get(
        path: '/admin/client-reviews',
        tags: ['Client Reviews'],
        security: [['sanctum' => []]],
        summary: 'Get client reviews',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Client reviews retrieved successfully'
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
        path: '/admin/client-reviews',
        tags: ['Client Reviews'],
        security: [['sanctum' => []]],
        summary: 'Create client review',
        responses: [
            new OA\Response(
                response: 201,
                description: 'Client review created successfully'
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
        path: '/admin/client-reviews/{id}',
        tags: ['Client Reviews'],
        security: [['sanctum' => []]],
        summary: 'Get client review',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Client review retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Not found'
            )
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/client-reviews/{id}',
        tags: ['Client Reviews'],
        security: [['sanctum' => []]],
        summary: 'Update client review',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Client review updated successfully'
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
        path: '/admin/client-reviews/{id}',
        tags: ['Client Reviews'],
        security: [['sanctum' => []]],
        summary: 'Delete client review',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Client review deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Not found'
            )
        ]
    )]
    public function destroy(): void
    {
    }
}
