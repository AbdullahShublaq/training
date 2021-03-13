<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'regions' => 'c,r,u,d',
            'employers' => 'c,r,u,d,v',
            'jobSeekers' => 'c,r,u,d,v',
            'jobs' => 'c,r,u,d',
        ],
        'admin' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'v' => 'verify'
    ]
];
