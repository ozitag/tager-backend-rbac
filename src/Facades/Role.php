<?php

namespace OZiTAG\Tager\Backend\Rbac\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Permissions
 * @package OZiTAG\Tager\Backend\Rbac\Facades
 * @method static array getUserScopes(User $user)
 * @method static \OZiTAG\Tager\Backend\Rbac\Roles\Role getUserRoleClass(User $user)
 */
class Role extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'role';
    }
}
