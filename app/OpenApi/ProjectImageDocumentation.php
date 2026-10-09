<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class ProjectImageDocumentation
{
    #[OA\Get(
        path: '/admin/projects/{project}/images',
        tags: ['Project Images'],
        security: [['sanctum' => []]],
        summary: 'Get project images',
        responses: [
            new OA\Response(response: 200, description: 'Images retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(): void
    {
    }


    #[OA\Post(
        path: '/admin/projects/{project}/images',
        tags: ['Project Images'],
        security: [['sanctum' => []]],
        summary: 'Upload project image',
        responses: [
            new OA\Response(response: 201, description: 'Image uploaded successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(): void
    {
    }


    #[OA\Delete(
        path: '/admin/projects/{project}/images/{id}',
        tags: ['Project Images'],
        security: [['sanctum' => []]],
        summary: 'Delete project image',
        responses: [
            new OA\Response(response: 200, description: 'Image deleted successfully'),
            new OA\Response(response: 404, description: 'Image not found')
        ]
    )]
    public function destroy(): void
    {
    }
}
