<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class PostDocumentation
{
    #[OA\Get(
        path: '/admin/posts',
        tags: ['Posts'],
        security: [['sanctum' => []]],
        summary: 'Get posts',
        responses: [
            new OA\Response(response: 200, description: 'Posts retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Post(
        path: '/admin/posts',
        tags: ['Posts'],
        security: [['sanctum' => []]],
        summary: 'Create post',
        responses: [
            new OA\Response(response: 201, description: 'Post created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(): void
    {
    }


    #[OA\Get(
        path: '/admin/posts/{id}',
        tags: ['Posts'],
        security: [['sanctum' => []]],
        summary: 'Get post',
        responses: [
            new OA\Response(response: 200, description: 'Post retrieved successfully'),
            new OA\Response(response: 404, description: 'Post not found')
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/posts/{id}',
        tags: ['Posts'],
        security: [['sanctum' => []]],
        summary: 'Update post',
        responses: [
            new OA\Response(response: 200, description: 'Post updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(): void
    {
    }


    #[OA\Delete(
        path: '/admin/posts/{id}',
        tags: ['Posts'],
        security: [['sanctum' => []]],
        summary: 'Delete post',
        responses: [
            new OA\Response(response: 200, description: 'Post deleted successfully'),
            new OA\Response(response: 404, description: 'Post not found')
        ]
    )]
    public function destroy(): void
    {
    }
}
