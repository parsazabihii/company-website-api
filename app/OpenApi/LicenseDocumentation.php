<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class LicenseDocumentation
{
    #[OA\Get(
        path: '/admin/licenses',
        tags: ['Licenses'],
        security: [['sanctum' => []]],
        summary: 'Get licenses',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Licenses retrieved successfully'
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
        path: '/admin/licenses',
        tags: ['Licenses'],
        security: [['sanctum' => []]],
        summary: 'Create license',
        responses: [
            new OA\Response(
                response: 201,
                description: 'License created successfully'
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
        path: '/admin/licenses/{id}',
        tags: ['Licenses'],
        security: [['sanctum' => []]],
        summary: 'Get license details',
        responses: [
            new OA\Response(
                response: 200,
                description: 'License retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'License not found'
            )
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/licenses/{id}',
        tags: ['Licenses'],
        security: [['sanctum' => []]],
        summary: 'Update license',
        responses: [
            new OA\Response(
                response: 200,
                description: 'License updated successfully'
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
        path: '/admin/licenses/{id}',
        tags: ['Licenses'],
        security: [['sanctum' => []]],
        summary: 'Delete license',
        responses: [
            new OA\Response(
                response: 200,
                description: 'License deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'License not found'
            )
        ]
    )]
    public function destroy(): void
    {
    }
}
