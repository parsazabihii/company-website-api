<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class EventDocumentation
{
    #[OA\Get(
        path: '/admin/events',
        tags: ['Events'],
        security: [['sanctum' => []]],
        summary: 'Get events',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Events retrieved successfully'
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
        path: '/admin/events',
        tags: ['Events'],
        security: [['sanctum' => []]],
        summary: 'Create event',
        responses: [
            new OA\Response(
                response: 201,
                description: 'Event created successfully'
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
        path: '/admin/events/{id}',
        tags: ['Events'],
        security: [['sanctum' => []]],
        summary: 'Get event details',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Event retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Not found'
            )
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/events/{id}',
        tags: ['Events'],
        security: [['sanctum' => []]],
        summary: 'Update event',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Event updated successfully'
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
        path: '/admin/events/{id}',
        tags: ['Events'],
        security: [['sanctum' => []]],
        summary: 'Delete event',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Event deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Not found'
            )
        ]
    )]
    public function destroy(): void
    {
    }
}
