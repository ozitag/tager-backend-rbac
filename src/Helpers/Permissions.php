<?php

namespace OZiTAG\Tager\Backend\Rbac\Helpers;

use Closure;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Config;
use OZiTAG\Tager\Backend\Auth\Helpers\ProvidersHelper;

class Permissions
{
    /**
     * @return array
     */
    public function getAllScopes() {
        $permissions = config('rbac.permissions');
        $list = [];
        foreach (array_keys($permissions) as $permission) {
            $list[$permission] = '';
            foreach (explode('.', $permission) as $part) {
                if($part !== '*') {
                    $list[$part . ".*"] = '';
                }
            }
        }
        return array_keys($list);
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
    public function checkUserScopes (array $scopes, User $user) {
        $userScopesTree = $this->getUserScopesTree($user);
        $result = true;
        foreach ($scopes as $scope) {
            if(!$this->checkUserScope($scope, $user, $userScopesTree)) {
                $result = false;
            }
        }
        return $result;
    }

    /**
     * @param string $scope
     * @param $user
     * @return mixed
     */
    public function checkUserScope (string $scope, User $user, array $userScopesTree = null) {
        return $this->checkScope(
            explode('.', $scope),
            $userScopesTree ?? $this->getUserScopesTree($user)
        );
    }


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
