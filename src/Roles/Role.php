<?php
namespace OZiTAG\Tager\Backend\Rbac\Roles;



interface Role
{
    /**
     * @return int
     */
    public static function getId() : int;

    /**
     * @return array
     */
    public static function getScopes() : array ;

    /**
     * @return string
     */
    public static function getLabel() : string;
}
