<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Role',
    required: ['id', 'name', 'slug', 'permissions'],
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1
        ),
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'Admin'
        ),
        new OA\Property(
            property: 'slug',
            type: 'string',
            example: 'admin'
        ),
        new OA\Property(
            property: 'permissions',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Permission'
            )
        ),
    ]
)]
final class RoleSchema
{
}
