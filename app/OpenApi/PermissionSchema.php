<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Permission',
    required: ['id', 'name', 'slug'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'Create Post'
        ),
        new OA\Property(
            property: 'slug',
            type: 'string',
            example: 'posts.create'
        ),
        new OA\Property(
            property: 'group_name',
            type: 'string',
            nullable: true,
            example: 'Posts'
        ),
    ]
)]
final class PermissionSchema
{
}
