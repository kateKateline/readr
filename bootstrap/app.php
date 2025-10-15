<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

return Application::configure(basePath: dirname(__DIR__))

    ->withProviders([
        CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider::class,
    ])

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
