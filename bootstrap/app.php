<?php

use App\Http\Middleware\CheckPermission;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'permission' => CheckPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request): bool => $request->is('api/*'),
        );

        $exceptions->render(
            function (
                ValidationException $exception,
                Request $request
            ): ?JsonResponse {
                if (! $request->is('api/*')) {
                    return null;
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $exception->errors(),
                ], $exception->status);
            }
        );

        $exceptions->render(
            function (
                AuthenticationException $exception,
                Request $request
            ): ?JsonResponse {
                if (! $request->is('api/*')) {
                    return null;
                }

                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage(),
                    'errors' => [],
                ], 401);
            }
        );

        $exceptions->render(
            function (
                NotFoundHttpException $exception,
                Request $request
            ): ?JsonResponse {
                if (! $request->is('api/*')) {
                    return null;
                }

                $previousException = $exception->getPrevious();

                $message = $previousException instanceof ModelNotFoundException
                    ? class_basename($previousException->getModel()).' not found.'
                    : 'Resource not found.';

                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'errors' => [],
                ], 404);
            }
        );
    })
    ->create();
