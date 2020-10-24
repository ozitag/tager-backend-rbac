<?php

namespace OZiTAG\Tager\Backend\Rbac\Helpers;

use Illuminate\Foundation\Auth\User;

class UserAccessControlHelper
{
    /**
     * @param User $user
     * @return array
     */
    public function getScopes(User $user) : array {
        return method_exists($user, 'getScopesForRbac') ? ($user->getScopesForRbac() ?? []) : [];
    }
    /**
     * @param User $user
     * @return array
     */
    public function getRoles(User $user) : array {
        return method_exists($user, 'getRolesForRbac') ? ($user->getRolesForRbac() ?? []) : [];
    }

    /**
     * @param array $roleIds
     * @param User $user
     * @return bool
     */
    public function checkOneOfUserRoles(array $roleIds, User $user) {
        $roles = $this->getRoles($user);
        foreach ($roleIds as $roleId) {
            if($this->checkUserRole($roleId, $user, $roles)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array $roleIds
     * @param User $user
     * @return bool
     */
    public function checkUserRoles(array $roleIds, User $user) {
        $roles = $this->getRoles($user);
        foreach ($roleIds as $roleId) {
            if(!$this->checkUserRole($roleId, $user, $roles)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param int $roleId
     * @param User $user
     * @param array $userRoles
     * @return mixed
     */
    public function checkUserRole(int $roleId, User $user, array $userRoles = []) {
        return in_array($roleId, $userRoles ? $userRoles : $this->getRoles($user));
    }

    /**
     * @param $user
     * @return array
     */
    public function getUserScopesTree(User $user) {
        return $this->buildUserScopesTree(
            [], array_map(fn($item) => explode('.', $item), $user->token()->scopes)
        );
    }

    /**
     * @param array $scopes
     * @param $user
     * @return bool
     */
    public function checkUserScopes(array $scopes, User $user) {
        $userScopesTree = $this->getUserScopesTree($user);
        foreach ($scopes as $scope) {
            if(!$this->checkUserScope($scope, $user, $userScopesTree)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string $scope
     * @param User $user
     * @param array|null $userScopesTree
     * @return mixed
     */
    public function checkUserScope(string $scope, User $user, array $userScopesTree = null) {
        return $this->checkScope(explode('.', $scope),$userScopesTree ?? $this->getUserScopesTree($user)
        );
    }

    // ******************* //
    // ***** SCOPES ****** //
    // ******************* //
    /**
     * @param $needle
     * @param $userScopes
     * @return mixed
     */
    protected function checkScope(array $needle, array $userScopes) {
        if(!$needle) {
            return true;
        }

        $needlePart = array_shift($needle);

        if(array_key_exists('*', $userScopes)) {
            return true;
        }

        if(array_key_exists($needlePart, $userScopes)) {
            return $this->checkScope($needle, $userScopes[$needlePart]);
        }

        return false;
    }

    /**
     * @param array $tree
     * @param array $scopes
     * @return array
     */
    protected function buildUserScopesTree(array $tree, array $scopes) {
        if(!$scopes) {
            return [];
        }
        foreach ($scopes as $parts) {
            $part = array_shift($parts);
            $tree[$part] = $tree[$part] ?? [];
            $tree[$part] = $this->addToTree($tree[$part], $parts);
        }
        return $tree;
    }

    /**
     * @param array $tree
     * @param array $parts
     * @return array
     */
    protected function addToTree(array $tree, array $parts) {
        if(!$parts) {
            return [];
        }
        $part = array_shift($parts);
        $tree[$part] = $tree[$part] ?? [];
        $tree[$part] = $this->addToTree($tree[$part], $parts);
        return $tree;
    }
}
