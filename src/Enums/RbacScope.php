<?php

namespace OZiTAG\Tager\Backend\Rbac\Enums;

use OZiTAG\Tager\Backend\Core\Enums\Enum;

final class RbacScope extends Enum
{
    const ViewRoles = 'rbac.view-roles';
    const CreateRoles = 'rbac.create-roles';
    const EditRoles = 'rbac.edit-roles';
    const DeleteRoles = 'rbac.delete-roles';
}
