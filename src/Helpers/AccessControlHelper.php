<?php

namespace OZiTAG\Tager\Backend\Rbac\Helpers;


use OZiTAG\Tager\Backend\Rbac\Facades\UserAccessControl;
use Illuminate\Foundation\Auth\User;

class AccessControlHelper {

    public function is(User $user, int $roleId) {
        return UserAccessControl::checkUserRole($roleId, $user);
    }

    public function isNot(User $user, int $roleId) {
        return !UserAccessControl::checkUserRole($roleId, $user);
    }

    public function can(User $user, ...$scopes) {
        return UserAccessControl::checkUserScopes($scopes, $user);
    }
}
