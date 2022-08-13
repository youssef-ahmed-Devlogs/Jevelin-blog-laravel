<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'articles' => 'c,r,u,d',
            'dashboard' => 'c,r,u,d',
            'comments' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'users' => 'c,r,u,d',
        ],
        'user' => [
            'articles' => 'cf,rf,uf,df',
        ]

    ],

    'permissions_map' => [
        'cf' => 'createfront',
        'rf' => 'readfront',
        'uf' => 'updatefront',
        'df' => 'deletefront',
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
