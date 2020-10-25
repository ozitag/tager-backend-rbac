<?php

namespace OZiTAG\Tager\Backend\Rbac\Helpers;

use Illuminate\Foundation\Auth\User;

class UserAccessControlHelper
{
    public function getScopes(User $user): array
    {
        return method_exists($user, 'getScopesForRbac') ? ($user->getScopesForRbac() ?? []) : [];
    }

    public function getRoles(User $user): array
    {
        return method_exists($user, 'getRolesForRbac') ? ($user->getRolesForRbac() ?? []) : [];
    }

    public function checkOneOfUserRoles(array $roleIds, User $user): bool
    {
        $roles = $this->getRoles($user);

        foreach ($roleIds as $roleId) {
            if ($this->checkUserRole($roleId, $user, $roles)) {
                return true;
            }
        }

        return false;
    }

    public function checkUserRoles(array $roleIds, User $user): bool
    {
        $roles = $this->getRoles($user);

        foreach ($roleIds as $roleId) {
            if (!$this->checkUserRole($roleId, $user, $roles)) {
                return false;
            }
        }

        return true;
    }

    public function checkUserRole(int $roleId, User $user, array $userRoles = []): bool
    {
        return in_array($roleId, $userRoles ? $userRoles : $this->getRoles($user));
    }

    public function getUserScopesTree(User $user): array
    {
        return $this->buildUserScopesTree(
            [], array_map(fn($item) => explode('.', $item), $user->token()->scopes)
        );
    }

    public function checkUserScopes(array $scopes, User $user): bool
    {
        $userScopesTree = $this->getUserScopesTree($user);

        foreach ($scopes as $scope) {
            if (!$this->checkUserScope($scope, $user, $userScopesTree)) {
                return false;
            }
        }

        return true;
    }

    public function checkUserScope(string $scope, User $user, array $userScopesTree = null): bool
    {
        return $this->checkScope(
            explode('.', $scope),
            $userScopesTree ?? $this->getUserScopesTree($user)
        );
    }

    // ******************* //
    // ***** SCOPES ****** //
    // ******************* //
    protected function checkScope(array $needle, array $userScopes): bool
    {
        if (!$needle) {
            return true;
        }

        $needlePart = array_shift($needle);

        if (array_key_exists('*', $userScopes)) {
            return true;
        }

        if (array_key_exists($needlePart, $userScopes)) {
            return $this->checkScope($needle, $userScopes[$needlePart]);
        }

        return false;
    }

    protected function buildUserScopesTree(array $tree, array $scopes): array
    {
        if (!$scopes) {
            return [];
        }

        foreach ($scopes as $parts) {
            $part = array_shift($parts);
            $tree[$part] = $tree[$part] ?? [];
            $tree[$part] = $this->addToTree($tree[$part], $parts);
        }

        return $tree;
    }

    protected function addToTree(array $tree, array $parts): array
    {
        if (!$parts) {
            return [];
        }

        $part = array_shift($parts);
        $tree[$part] = $tree[$part] ?? [];
        $tree[$part] = $this->addToTree($tree[$part], $parts);

        return $tree;
    }
}
