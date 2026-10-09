<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'User',
    required: [
        'id',
        'first_name',
        'last_name',
        'email',
        'is_active',
        'role',
    ],
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1
        ),
        new OA\Property(
            property: 'first_name',
            type: 'string',
            example: 'Admin'
        ),
        new OA\Property(
            property: 'last_name',
            type: 'string',
            example: 'User'
        ),
        new OA\Property(
            property: 'email',
            type: 'string',
            format: 'email',
            example: 'admin@example.com'
        ),
        new OA\Property(
            property: 'phone',
            type: 'string',
            nullable: true,
            example: null
        ),
        new OA\Property(
            property: 'avatar',
            type: 'string',
            nullable: true,
            example: 'avatars/admin.jpg'
        ),
        new OA\Property(
            property: 'is_active',
            type: 'boolean',
            example: true
        ),
        new OA\Property(
            property: 'last_login_at',
            type: 'string',
            format: 'date-time',
            nullable: true
        ),
        new OA\Property(
            property: 'role',
            ref: '#/components/schemas/Role'
        ),
    ]
)]
final class UserSchema
{
}
