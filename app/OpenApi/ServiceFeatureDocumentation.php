<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class ServiceFeatureDocumentation
{
    #[OA\Get(
        path: '/admin/services/{service}/features',
        tags: ['Service Features'],
        security: [['sanctum' => []]],
        summary: 'Get service features',
        responses: [
            new OA\Response(response: 200, description: 'Features retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Post(
        path: '/admin/services/{service}/features',
        tags: ['Service Features'],
        security: [['sanctum' => []]],
        summary: 'Create service feature',
        responses: [
            new OA\Response(response: 201, description: 'Feature created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(): void
    {
    }


    #[OA\Get(
        path: '/admin/services/{service}/features/{id}',
        tags: ['Service Features'],
        security: [['sanctum' => []]],
        summary: 'Get service feature',
        responses: [
            new OA\Response(response: 200, description: 'Feature retrieved successfully'),
            new OA\Response(response: 404, description: 'Feature not found')
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/services/{service}/features/{id}',
        tags: ['Service Features'],
        security: [['sanctum' => []]],
        summary: 'Update service feature',
        responses: [
            new OA\Response(response: 200, description: 'Feature updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(): void
    {
    }


    #[OA\Delete(
        path: '/admin/services/{service}/features/{id}',
        tags: ['Service Features'],
        security: [['sanctum' => []]],
        summary: 'Delete service feature',
        responses: [
            new OA\Response(response: 200, description: 'Feature deleted successfully'),
            new OA\Response(response: 404, description: 'Feature not found')
        ]
    )]
    public function destroy(): void
    {
    }
}
