<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /* -------------------------------------------------------------
     |  Middleware global
     | ------------------------------------------------------------ */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /* -------------------------------------------------------------
     |  Grupos web / api
     | ------------------------------------------------------------ */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
    /* -------------------------------------------------------------|  Aliases (para usar en rutas)
    | ------------------------------------------------------------ */
    protected $middlewareAliases = [
    // Laravel
    'auth'     => \App\Http\Middleware\Authenticate::class,
    'guest'    => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

    // Personalizado
    'guest.role' => \App\Http\Middleware\RedirectIfAuthenticatedByRole::class,

    // Spatie Permission  (SINGULAR “Middleware”)
    'role'               => \Spatie\Permission\Middleware\RoleMiddleware::class,
    'permission'         => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
];


}