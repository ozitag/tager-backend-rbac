<?php

namespace OZiTAG\Tager\Backend\Rbac\Facades;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Facade;
use OZiTAG\Tager\Backend\Rbac\Helpers\UserAccessControlHelper;

/**
 * Class Permissions
 * @package OZiTAG\Tager\Backend\Rbac\Facades
 * @method static array getScopes(User $user)
 * @method static array getRoles(User $user)
 * @method static array getUserScopesTree(User $user)
 * @method static bool checkUserScopes(array $scopes, User $user)
 * @method static bool checkUserScope(string $scope, User $user, array $userScopesTree = null)
 * @method static bool checkUserRoles(array $roleIds, User $user)
 * @method static bool checkOneOfUserRoles(array $roleIds, User $user)
 * @method static bool checkUserRole(int $roleId, User $user, array $userRoles = [])
 */
class UserAccessControl extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return UserAccessControlHelper::class;
    }
}
