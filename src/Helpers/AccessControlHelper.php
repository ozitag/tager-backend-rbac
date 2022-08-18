<?php

namespace OZiTAG\Tager\Backend\Rbac\Helpers;

use OZiTAG\Tager\Backend\Rbac\Facades\UserAccessControl;
use Illuminate\Foundation\Auth\User;
use OZiTAG\Tager\Backend\Rbac\Models\Role;

class AccessControlHelper
{
    public function is(User $user, int $roleId): bool
    {
        return UserAccessControl::checkUserRole($roleId, $user);
    }

    public function isNot(User $user, int $roleId): bool
    {
        return !UserAccessControl::checkUserRole($roleId, $user);
    }

    public function can(User $user, ...$scopes): bool
    {
        return UserAccessControl::checkUserScopes($scopes, $user);
    }

    public function isSuperAdmin(User $user): bool
    {
        return $this->is($user, Role::getSuperAdminRoleId());
    }
}
