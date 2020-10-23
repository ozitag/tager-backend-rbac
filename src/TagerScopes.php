<?php

namespace OZiTAG\Tager\Backend\Rbac;

class TagerScopes
{
    private static $scopes = [];

    public static function register($scope, $label)
    {
        if (!isset(self::$scopes['*'])) {
            self::$scopes['*'] = [
                'name' => 'Other',
                'scopes' => []
            ];
        }

        self::$scopes['*']['scopes'][] = [
            'name' => $label,
            'scope' => $scope
        ];
    }

    public static function registerGroup($groupName, $scopes)
    {
        if (!isset(self::$scopes[$groupName])) {

            $childrenScopes = [];
            foreach ($scopes as $scope => $label) {
                $childrenScopes[] = [
                    'name' => $label,
                    'scope' => $scope
                ];
            }

            self::$scopes[$groupName] = [
                'name' => $groupName,
                'scopes' => $childrenScopes
            ];
        }
    }

    public static function getScopes()
    {
        return self::$scopes;
    }

    /**
     * @param string $scope
     * @return bool
     */
    public static function isScopeExists($scope)
    {
        foreach (self::$scopes as $group) {
            foreach ($group['scopes'] as $_scope) {
                if ($_scope['scope'] == $scope) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param string $scope
     * @return string|null
     */
    public static function getScopeLabel($scope)
    {
        foreach (self::$scopes as $group) {
            foreach ($group['scopes'] as $_scope) {
                if ($_scope['scope'] == $scope) {
                    return $_scope['name'];
                }
            }
        }

        return null;
    }
}
