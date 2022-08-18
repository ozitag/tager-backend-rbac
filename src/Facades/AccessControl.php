<?php

namespace OZiTAG\Tager\Backend\Rbac\Facades;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Facade;
use OZiTAG\Tager\Backend\Rbac\Helpers\AccessControlHelper;

/**
 * Class Permissions
 * @package OZiTAG\Tager\Backend\Rbac\Facades
 * @method static bool is(User $user, int $roleId)
 * @method static bool isNot(User $user, int $roleId)
 * @method static bool can(User $user, ...$scopes)
 * @method static bool isSuperAdmin(User $user)
 */
class AccessControl extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AccessControlHelper::class;
    }
}
