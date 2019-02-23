<?php
return [
    'admin' => [
        'type' => 1,
        'description' => 'Админ',
        'ruleName' => 'allusers',
        'children' => [
            'vektan',
            'latuz',
            'table',
            'manageUsers',
        ],
    ],
    'vektan' => [
        'type' => 1,
        'description' => 'Вектан',
        'ruleName' => 'allusers',
        'children' => [],
    ],
    'latuz' => [
        'type' => 1,
        'description' => 'Латуз',
        'ruleName' => 'allusers',
        'children' => [],
    ],
    'manageUsers' => [
        'type' => 2,
        'description' => 'Manage users',
        'ruleName' => 'allusers',
    ],
];
