<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class SliderDocumentation
{
    #[OA\Get(
        path: '/admin/sliders',
        tags: ['Sliders'],
        security: [['sanctum' => []]],
        summary: 'Get sliders',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Sliders retrieved successfully'
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
        path: '/admin/sliders',
        tags: ['Sliders'],
        security: [['sanctum' => []]],
        summary: 'Create slider',
        responses: [
            new OA\Response(
                response: 201,
                description: 'Slider created successfully'
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
        path: '/admin/sliders/{id}',
        tags: ['Sliders'],
        security: [['sanctum' => []]],
        summary: 'Get slider details',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Slider retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Slider not found'
            )
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/sliders/{id}',
        tags: ['Sliders'],
        security: [['sanctum' => []]],
        summary: 'Update slider',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Slider updated successfully'
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
        path: '/admin/sliders/{id}',
        tags: ['Sliders'],
        security: [['sanctum' => []]],
        summary: 'Delete slider',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Slider deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Slider not found'
            )
        ]
    )]
    public function destroy(): void
    {
    }
}
