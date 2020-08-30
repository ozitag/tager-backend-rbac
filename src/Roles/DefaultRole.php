<?php
namespace OZiTAG\Tager\Backend\Rbac\Roles;



class DefaultRole implements Role
{
    /**
     * @return int
     */
    public static function getId() : int {
        return 0;
    }

    /**
     * @return array
     */
    public static function getScopes() : array {
        return [];
    }

    /**
     * @return string
     */
    public static function getLabel() : string {
        return 'Default';
    }
}
