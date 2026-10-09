<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class ServiceDocumentation
{
    #[OA\Get(
        path: '/admin/services',
        tags: ['Services'],
        security: [['sanctum' => []]],
        summary: 'Get services',
        responses: [
            new OA\Response(response: 200, description: 'Services retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Post(
        path: '/admin/services',
        tags: ['Services'],
        security: [['sanctum' => []]],
        summary: 'Create service',
        responses: [
            new OA\Response(response: 201, description: 'Service created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(): void
    {
    }


    #[OA\Get(
        path: '/admin/services/{id}',
        tags: ['Services'],
        security: [['sanctum' => []]],
        summary: 'Get service details',
        responses: [
            new OA\Response(response: 200, description: 'Service retrieved successfully'),
            new OA\Response(response: 404, description: 'Service not found')
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/services/{id}',
        tags: ['Services'],
        security: [['sanctum' => []]],
        summary: 'Update service',
        responses: [
            new OA\Response(response: 200, description: 'Service updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(): void
    {
    }


    #[OA\Delete(
        path: '/admin/services/{id}',
        tags: ['Services'],
        security: [['sanctum' => []]],
        summary: 'Delete service',
        responses: [
            new OA\Response(response: 200, description: 'Service deleted successfully'),
            new OA\Response(response: 404, description: 'Service not found')
        ]
    )]
    public function destroy(): void
    {
    }
}
