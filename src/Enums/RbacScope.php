<?php

namespace OZiTAG\Tager\Backend\Rbac\Enums;

use OZiTAG\Tager\Backend\Core\Enums\Enum;

enum RbacScope:string
{
    case ViewRoles = 'rbac.view-roles';
    case CreateRoles = 'rbac.create-roles';
    case EditRoles = 'rbac.edit-roles';
    case DeleteRoles = 'rbac.delete-roles';
}
