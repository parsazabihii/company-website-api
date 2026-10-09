<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class CategoryDocumentation
{
    #[OA\Get(
        path: '/admin/categories',
        tags: ['Categories'],
        security: [['sanctum' => []]],
        summary: 'Get categories',
        responses: [
            new OA\Response(response: 200, description: 'Categories retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void {}


    #[OA\Post(
        path: '/admin/categories',
        tags: ['Categories'],
        security: [['sanctum' => []]],
        summary: 'Create category',
        responses: [
            new OA\Response(response: 201, description: 'Category created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(): void {}


    #[OA\Get(
        path: '/admin/categories/{id}',
        tags: ['Categories'],
        security: [['sanctum' => []]],
        summary: 'Get category',
        responses: [
            new OA\Response(response: 200, description: 'Category retrieved successfully'),
            new OA\Response(response: 404, description: 'Not found')
        ]
    )]
    public function show(): void {}


    #[OA\Patch(
        path: '/admin/categories/{id}',
        tags: ['Categories'],
        security: [['sanctum' => []]],
        summary: 'Update category',
        responses: [
            new OA\Response(response: 200, description: 'Category updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(): void {}


    #[OA\Delete(
        path: '/admin/categories/{id}',
        tags: ['Categories'],
        security: [['sanctum' => []]],
        summary: 'Delete category',
        responses: [
            new OA\Response(response: 200, description: 'Category deleted successfully'),
            new OA\Response(response: 404, description: 'Not found')
        ]
    )]
    public function destroy(): void {}
}
