<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'AuthData',
    required: [
        'token_type',
        'access_token',
        'access_token_expires_at',
        'refresh_token',
        'refresh_token_expires_at',
        'user',
    ],
    properties: [
        new OA\Property(
            property: 'token_type',
            type: 'string',
            example: 'Bearer'
        ),
        new OA\Property(
            property: 'access_token',
            type: 'string',
            example: '1|sanctum-access-token'
        ),
        new OA\Property(
            property: 'access_token_expires_at',
            type: 'string',
            format: 'date-time'
        ),
        new OA\Property(
            property: 'refresh_token',
            type: 'string',
            example: 'plain-text-refresh-token'
        ),
        new OA\Property(
            property: 'refresh_token_expires_at',
            type: 'string',
            format: 'date-time'
        ),
        new OA\Property(
            property: 'user',
            ref: '#/components/schemas/User'
        ),
    ]
)]
final class AuthDataSchema
{
}
