<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,        

    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\LocaleMiddleware::class,
        ],
        'auth_admin'=>
        [ 
            \App\Http\Middleware\Admin\AuthMiddleware::class,
        ],
        'admin_auth_check'=>
        [ 
            \App\Http\Middleware\Admin\CheckAuthMiddleware::class,
        ],
        'supervisor_admin'=>
        [ 
            \App\Http\Middleware\Supervisor\AuthMiddleware::class,
        ],
        'supervisor_auth_check'=>
        [ 
            \App\Http\Middleware\Supervisor\CheckAuthMiddleware::class,
        ],
         'auth_creator'=>
        [ 
            \App\Http\Middleware\Creator\AuthMiddleware::class,
        ],
        'creator_auth_check'=>
        [ 
            \App\Http\Middleware\Creator\CheckAuthMiddleware::class,
        ],
        'front_general'=>
        [ 
            \App\Http\Middleware\Front\GeneralMiddleware::class,
        ],
        'users'=>
        [ 
            \App\Http\Middleware\Front\UsersMiddleware::class,
        ],
        'users_auth_check'=>
        [ 
            \App\Http\Middleware\Front\CheckUsersAuthMiddleware::class,
        ],
        'module_permission'=>[
            \App\Http\Middleware\Admin\VerifyPermission::class
        ],
        'route-check'=>[
            \App\Http\Middleware\Front\RoutingMiddleware::class,
        ],        
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'              => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'        => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'          => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'               => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'             => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'          => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'auth_admin'        => \App\Http\Middleware\Admin\AuthMiddleware::class,
        'auth_supervisor'   => \App\Http\Middleware\Supervisor\AuthMiddleware::class,
        'auth_creator'      => \App\Http\Middleware\Creator\AuthMiddleware::class,
        'front_general'     => \App\Http\Middleware\Front\GeneralMiddleware::class,
        'users'             => \App\Http\Middleware\Front\UsersMiddleware::class,
        'module_permission' => \App\Http\Middleware\Admin\VerifyPermission::class,
        'wechat.oauth'      => \Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class,
    ];
}
