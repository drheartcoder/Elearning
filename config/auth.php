<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver'   => 'token',
            'provider' => 'users',
        ],

        'admin' => [
            'driver'   => 'session',
            'provider' => 'admin',
            'password' => 'admin',
        ],

       /* 'subadmin' => [
            'driver'   => 'session',
            'provider' => 'subadmin',
            'password' => 'subadmin',
        ],*/

        'supervisor' => [
            'driver'   => 'session',
            'provider' => 'supervisor',
            'password' => 'supervisor',
        ],

        'creator' => [
            'driver'   => 'session',
            'provider' => 'creator',
            'password' => 'creator',
        ],
        'users' => [
            'driver'   => 'session',
            'provider' => 'users',
            'password' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\User::class,
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model'  => App\Models\UsersModel::class,
        ],
        /*'subadmin' => [
            'driver' => 'eloquent',
            'model'  => App\Models\UsersModel::class,
        ],*/
        'supervisor' => [
            'driver' => 'eloquent',
            'model'  => App\Models\UsersModel::class,
        ],
        'creator' => [
            'driver' => 'eloquent',
            'model'  => App\Models\UsersModel::class,
        ],
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\UsersModel::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_resets',
            'expire'   => 60,
        ],
        'admin' => [
            'provider' => 'admin',
            'email'    => 'email.general',
            'table'    => 'password_resets',
            'expire'   =>  120,
        ],/*
        'subadmin' => [
            'provider' => 'subadmin',
            'email'    => 'email.general',
            'table'    => 'password_resets',
            'expire'   =>  120,
        ],*/
        'supervisor' => [
            'provider' => 'supervisor',
            'email'    => 'email.general',
            'table'    => 'password_resets',
            'expire'   =>  120,
        ],
        'creator' => [
            'provider' => 'creator',
            'email'    => 'email.general',
            'table'    => 'password_resets',
            'expire'   =>  120,
        ],
        'users' => [
            'provider' => 'users',
            'email'    => 'email.general',
            'table'    => 'password_resets',
            'expire'   =>  120,
        ],
    ],

    'password_hasher'     => 'on',
    'use_custom_template' => 'on',
    'user_mode'           => 'student'

];
