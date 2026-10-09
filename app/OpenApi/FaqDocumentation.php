<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

final class FaqDocumentation
{
    #[OA\Get(
        path: '/admin/faqs',
        tags: ['FAQs'],
        security: [['sanctum' => []]],
        summary: 'Get FAQs',
        responses: [
            new OA\Response(
                response: 200,
                description: 'FAQs retrieved successfully'
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
        path: '/admin/faqs',
        tags: ['FAQs'],
        security: [['sanctum' => []]],
        summary: 'Create FAQ',
        responses: [
            new OA\Response(
                response: 201,
                description: 'FAQ created successfully'
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
        path: '/admin/faqs/{id}',
        tags: ['FAQs'],
        security: [['sanctum' => []]],
        summary: 'Get FAQ details',
        responses: [
            new OA\Response(
                response: 200,
                description: 'FAQ retrieved successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'FAQ not found'
            )
        ]
    )]
    public function show(): void
    {
    }


    #[OA\Patch(
        path: '/admin/faqs/{id}',
        tags: ['FAQs'],
        security: [['sanctum' => []]],
        summary: 'Update FAQ',
        responses: [
            new OA\Response(
                response: 200,
                description: 'FAQ updated successfully'
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
        path: '/admin/faqs/{id}',
        tags: ['FAQs'],
        security: [['sanctum' => []]],
        summary: 'Delete FAQ',
        responses: [
            new OA\Response(
                response: 200,
                description: 'FAQ deleted successfully'
            ),
            new OA\Response(
                response: 404,
                description: 'FAQ not found'
            )
        ]
    )]
    public function destroy(): void
    {
    }
}
