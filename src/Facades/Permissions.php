<?php

namespace OZiTAG\Tager\Backend\Rbac\Facades;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Facade;

/**
 * Class Permissions
 * @package OZiTAG\Tager\Backend\Rbac\Facades
 * @method static array getAllScopes()
 * @method static array getUserScopesTree(User $user)
 * @method static bool checkUserScopes(array $scopes, User $user)
 * @method static bool checkUserScope(string $scope, User $user, array $userScopesTree = null)
 */
class Permissions extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'permissions';
    }
}
