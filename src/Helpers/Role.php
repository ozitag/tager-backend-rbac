<?php

namespace OZiTAG\Tager\Backend\Rbac\Helpers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Config;
use OZiTAG\Tager\Backend\Auth\Helpers\ProvidersHelper;

class Role
{
    /**
     * @param $userRoleId
     * @return \OZiTAG\Tager\Backend\Rbac\Roles\Role
     * @throws \Exception
     */
    protected function getAppRole($userRoleId) : string {
        $appRole = config('rbac.providers')[config('auth.guards.api.provider')]['roles'][$userRoleId] ?? (
            config('rbac.providers.default.roles')[$userRoleId] ?? null
        );

        if(!$appRole) {
            throw new \Exception('Invalid RBAC Config');
        }

        return $appRole;
    }

    /**
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function getUserScopesByRole(User $user) : array {
        return $this->getAppRole($user->role_id)::getScopes();
    }

    /**
     * @param User $user
     * @return \OZiTAG\Tager\Backend\Rbac\Roles\Role
     * @throws \Exception
     */
    public function getUserRoleClass(User $user) : string {
        return $this->getAppRole($user->role_id);
    }
}
