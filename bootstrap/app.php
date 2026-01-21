<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        // WEB
        $middleware->web(append: [
            HandleAppearance::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        // API
        $middleware->api([
            'throttle:api',
            SubstituteBindings::class,
        ]);

        $middleware->append(
            \App\Http\Middleware\TrustProxy::class
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    })
    ->create();

/*
|--------------------------------------------------------------------------
| Rate Limiter (ต้องอยู่หลัง create())
|--------------------------------------------------------------------------
*/
$app->booted(function () {
    RateLimiter::for('api', function (Request $request) {
        return Limit::perMinute(60)->by(
            $request->user()?->id ?: $request->ip()
        );
    });
});

return $app;
