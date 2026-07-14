<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'route_admin'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'route_washer'])
                ->prefix('profissional')
                ->name('profissional.')
                ->group(base_path('routes/washer.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([

            'admin' => \App\Http\Middleware\CheckScopeAdmin::class,
            'client' => \App\Http\Middleware\CheckScopeClient::class,
            'washer' => \App\Http\Middleware\CheckScopeWasher::class,
            'route_admin' => \App\Http\Middleware\RouteAdmin::class,
            'route_client' => \App\Http\Middleware\RouteClient::class,
            'route_washer' => \App\Http\Middleware\RouteWasher::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
