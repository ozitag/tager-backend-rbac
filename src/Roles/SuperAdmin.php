<?php
namespace OZiTAG\Tager\Backend\Rbac\Roles;



class SuperAdmin implements Role
{
    /**
     * @return int
     */
    public static function getId() : int {
        return 1;
    }

    /**
     * @return array
     */
    public static function getScopes() : array {
        return ['*'];
    }

    /**
     * @return string
     */
    public static function getLabel() : string {
        return 'SuperAdmin';
    }
}
