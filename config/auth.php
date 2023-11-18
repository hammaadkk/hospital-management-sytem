<?php

return [

    

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'nurse' => [
            'driver' => 'session',
            'provider' => 'nurses',
        ],

        'receptionist' => [
            'driver' => 'session',
            'provider' => 'receptionists',
        ],
        'labassistant' => [
            'driver' => 'session',
            'provider' => 'labassistants',
        ],
        'doctor' => [
            'driver' => 'session',
            'provider' => 'doctor',
        ],
        'store' => [
            'driver' => 'session',
            'provider' => 'Store',
        ],
        
        
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'nurses' => [
            'driver' => 'eloquent',
            'model' => App\Models\Nurse::class,
        ],

        'receptionists' => [
            'driver' => 'eloquent',
            'model' => App\Models\Receptionist::class,
        ],
        'labassistants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Labassistant::class,
        ],
        'doctor' => [
            'driver' => 'eloquent',
            'model' => App\Models\Doctor::class,
        ],
        'store' => [
            'driver' => 'eloquent',
            'model' => App\Models\Store::class,
        ],
        
        
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];

  