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
    protected function getAppRole($userRoleId) : ?string {

        $appRole = config('rbac.providers')[config('auth.guards.api.provider')][$userRoleId] ?? null;

        return $appRole;
    }

    /**
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function getUserScopes(User $user) : array {
        $appRole = $this->getAppRole($user->role_id);
        return $appRole ? $appRole::getScopes() : [];
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
