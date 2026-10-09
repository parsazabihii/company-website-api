<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class ProjectDocumentation
{
    #[OA\Get(
        path: '/admin/projects',
        tags: ['Projects'],
        security: [['sanctum' => []]],
        summary: 'Get projects',
        responses: [
            new OA\Response(response: 200, description: 'Projects retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Post(
        path: '/admin/projects',
        tags: ['Projects'],
        security: [['sanctum' => []]],
        summary: 'Create project',
        responses: [
            new OA\Response(response: 201, description: 'Project created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(): void
    {
    }


    #[OA\Get(
        path: '/admin/projects/{id}',
        tags: ['Projects'],
        security: [['sanctum' => []]],
        summary: 'Get project',
        responses: [
            new OA\Response(response: 200, description: 'Project retrieved successfully'),
            new OA\Response(response: 404, description: 'Project not found')
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/projects/{id}',
        tags: ['Projects'],
        security: [['sanctum' => []]],
        summary: 'Update project',
        responses: [
            new OA\Response(response: 200, description: 'Project updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(): void
    {
    }


    #[OA\Delete(
        path: '/admin/projects/{id}',
        tags: ['Projects'],
        security: [['sanctum' => []]],
        summary: 'Delete project',
        responses: [
            new OA\Response(response: 200, description: 'Project deleted successfully'),
            new OA\Response(response: 404, description: 'Project not found')
        ]
    )]
    public function destroy(): void
    {
    }
}
