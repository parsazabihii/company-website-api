<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'AuthenticationError',
    required: ['success', 'message', 'errors'],
    properties: [
        new OA\Property(
            property: 'success',
            type: 'boolean',
            example: false
        ),
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'Invalid credentials.'
        ),
        new OA\Property(
            property: 'errors',
            type: 'array',
            items: new OA\Items(type: 'string'),
            example: []
        ),
    ]
)]
final class AuthenticationErrorSchema
{
}
