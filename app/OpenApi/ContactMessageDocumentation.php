<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class ContactMessageDocumentation
{
    #[OA\Get(
        path: '/admin/contact-messages',
        tags: ['Contact Messages'],
        security: [['sanctum' => []]],
        summary: 'Get contact messages',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Contact messages retrieved successfully'
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


    #[OA\Get(
        path: '/admin/contact-messages/{id}',
        tags: ['Contact Messages'],
        security: [['sanctum' => []]],
        summary: 'Get contact message details',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Contact message retrieved successfully'
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
        path: '/admin/contact-messages/{id}',
        tags: ['Contact Messages'],
        security: [['sanctum' => []]],
        summary: 'Update contact message status',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Contact message updated successfully'
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
        path: '/admin/contact-messages/{id}',
        tags: ['Contact Messages'],
        security: [['sanctum' => []]],
        summary: 'Delete contact message',
        responses: [
            new OA\Response(
                response: 200,
                description: 'Contact message deleted successfully'
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
