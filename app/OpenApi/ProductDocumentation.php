<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class ProductDocumentation
{
    #[OA\Get(
        path: '/admin/products',
        tags: ['Products'],
        security: [['sanctum' => []]],
        summary: 'Get products',
        responses: [
            new OA\Response(response: 200, description: 'Products retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Post(
        path: '/admin/products',
        tags: ['Products'],
        security: [['sanctum' => []]],
        summary: 'Create product',
        responses: [
            new OA\Response(response: 201, description: 'Product created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(): void
    {
    }


    #[OA\Get(
        path: '/admin/products/{id}',
        tags: ['Products'],
        security: [['sanctum' => []]],
        summary: 'Get product',
        responses: [
            new OA\Response(response: 200, description: 'Product retrieved successfully'),
            new OA\Response(response: 404, description: 'Product not found')
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/products/{id}',
        tags: ['Products'],
        security: [['sanctum' => []]],
        summary: 'Update product',
        responses: [
            new OA\Response(response: 200, description: 'Product updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(): void
    {
    }


    #[OA\Delete(
        path: '/admin/products/{id}',
        tags: ['Products'],
        security: [['sanctum' => []]],
        summary: 'Delete product',
        responses: [
            new OA\Response(response: 200, description: 'Product deleted successfully'),
            new OA\Response(response: 404, description: 'Product not found')
        ]
    )]
    public function destroy(): void
    {
    }
}
