<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class SubBrandDocumentation
{
    #[OA\Get(
        path: '/admin/sub-brands',
        tags: ['Sub Brands'],
        security: [['sanctum' => []]],
        summary: 'Get sub brands',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sub brands retrieved successfully'
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
        path: '/admin/sub-brands',
        tags: ['Sub Brands'],
        security: [['sanctum' => []]],
        summary: 'Create sub brand',
        responses: [
            new OA\Response(
                response: 201,
                description: 'Sub brand created successfully'
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
        path: '/admin/sub-brands/{id}',
        tags: ['Sub Brands'],
        security: [['sanctum' => []]],
        summary: 'Get sub brand details',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sub brand retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Sub brand not found'
            )
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/sub-brands/{id}',
        tags: ['Sub Brands'],
        security: [['sanctum' => []]],
        summary: 'Update sub brand',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sub brand updated successfully'
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
        path: '/admin/sub-brands/{id}',
        tags: ['Sub Brands'],
        security: [['sanctum' => []]],
        summary: 'Delete sub brand',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sub brand deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Sub brand not found'
            )
        ]
    )]
    public function destroy(): void
    {
    }
}
