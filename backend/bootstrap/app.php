<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

// use Throwable;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Render API exception responses as JSON when the request is for an API route.
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );

        $exceptions->render(function (
            ValidationException $e,
            Request $request

        ) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Failed',
                    'errors' => $e->errors(),
                ], 422);
            }
        });
        // Standart API exception responses as JSON when the request is for an API route.
        $exceptions->render(function (
            Throwable $e,
            Request $request

        ) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    // 'message; => $e->getMessage(),' /** Uncomment this line to show the exception message in the response. */
                    //'message' => 'An unexpected error occurred. Please try again later.',
                    //'data' => null,

                    'message' => $e->getMessage(),
                    'exception' => get_class($e),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ], 500);
            }
        });

    })->create();
