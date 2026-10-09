<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class MenuDocumentation
{
    #[OA\Get(
        path: '/admin/menus',
        tags: ['Menus'],
        security: [['sanctum' => []]],
        summary: 'Get menus',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Menus retrieved successfully'
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
        path: '/admin/menus',
        tags: ['Menus'],
        security: [['sanctum' => []]],
        summary: 'Create menu',
        responses: [
            new OA\Response(
                response: 201,
                description: 'Menu created successfully'
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
        path: '/admin/menus/{id}',
        tags: ['Menus'],
        security: [['sanctum' => []]],
        summary: 'Get menu details',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Menu retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Menu not found'
            )
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/menus/{id}',
        tags: ['Menus'],
        security: [['sanctum' => []]],
        summary: 'Update menu',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Menu updated successfully'
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
        path: '/admin/menus/{id}',
        tags: ['Menus'],
        security: [['sanctum' => []]],
        summary: 'Delete menu',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Menu deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Menu not found'
            )
        ]
    )]
    public function destroy(): void
    {
    }
}
