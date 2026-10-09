<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Company Website API',
    description: 'RESTful API documentation for the company website backend.'
)]
#[OA\Server(
    url: '/api',
    description: 'Company Website API'
)]
#[OA\SecurityScheme(
    securityScheme: 'sanctum',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'Sanctum'
)]
#[OA\Tag(
    name: 'Authentication',
    description: 'Admin panel authentication endpoints.'
)]
final class OpenApiSpec
{
}
