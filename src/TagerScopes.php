<?php

namespace OZiTAG\Tager\Backend\Rbac;

class TagerScopes
{
    private static $scopes = [];

    public static function register(string $scope, string $label)
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

    public static function registerGroup(string $groupName, array $scopes)
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

    public static function isScopeExists(string $scope): bool
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

    public static function getScopeLabel(string $scope): ?string
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
