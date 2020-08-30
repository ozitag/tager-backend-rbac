<?php

use \OZiTAG\Tager\Backend\Rbac\Roles\SuperAdmin;
use \OZiTAG\Tager\Backend\Rbac\Roles\DefaultRole;

return [
    'providers' => [
        'default' => [
            'roles' => [
                SuperAdmin::getId() => SuperAdmin::class,
                DefaultRole::getId() => DefaultRole::class,
            ]
        ],
    ],
    'permissions' => [
        '*'
    ],
];
