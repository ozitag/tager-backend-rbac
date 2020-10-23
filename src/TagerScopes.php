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
}
