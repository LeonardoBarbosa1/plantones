<?php
return [
    '/login' => 'site/login',
    '/register' => 'site/register',

    '/gii' => '/gii',

    '/' => 'duty/index',
    'duty/swap' => 'duty/swap',
    'duty/delete' => 'duty/delete',
    'duty/<id:\w+>/activate' => 'duty/activate',

    'user' => 'user/index',
    'user/<id:\w+>/profile' => 'user/profile',
    'user/<id:\w+>/update' => 'user/update',
    'user/<id:\w+>/update-profile' => 'user/update-profile',
    'user/<id:\w+>/view' => 'user/view',

    'duty-activities/create' => 'duty-activities/create',
];