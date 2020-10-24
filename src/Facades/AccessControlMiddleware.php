<?php

namespace OZiTAG\Tager\Backend\Rbac\Facades;

use Illuminate\Support\Facades\Facade;
use OZiTAG\Tager\Backend\Rbac\Helpers\AccessControlMiddlewareHelper;

/**
 * Class Permissions
 * @package OZiTAG\Tager\Backend\Rbac\Facades
 * @method static string roles(...$ids)
 * @method static string allRoles(...$ids)
 * @method static string exceptRoles(...$ids)
 * @method static string scopes(...$scopes)
 */
class AccessControlMiddleware extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AccessControlMiddlewareHelper::class;
    }
}
