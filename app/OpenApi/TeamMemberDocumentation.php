<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class TeamMemberDocumentation
{
    #[OA\Get(
        path: '/admin/team-members',
        tags: ['Team Members'],
        security: [['sanctum' => []]],
        summary: 'Get team members',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Team members retrieved successfully'
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
        path: '/admin/team-members',
        tags: ['Team Members'],
        security: [['sanctum' => []]],
        summary: 'Create team member',
        responses: [
            new OA\Response(
                response: 201,
                description: 'Team member created successfully'
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
        path: '/admin/team-members/{id}',
        tags: ['Team Members'],
        security: [['sanctum' => []]],
        summary: 'Get team member details',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Team member retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Team member not found'
            )
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/team-members/{id}',
        tags: ['Team Members'],
        security: [['sanctum' => []]],
        summary: 'Update team member',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Team member updated successfully'
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
        path: '/admin/team-members/{id}',
        tags: ['Team Members'],
        security: [['sanctum' => []]],
        summary: 'Delete team member',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Team member deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'Team member not found'
            )
        ]
    )]
    public function destroy(): void
    {
    }
}
