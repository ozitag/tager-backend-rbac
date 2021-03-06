<?php

namespace OZiTAG\Tager\Backend\Rbac\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Rbac\Models\Role;

class RoleRepository extends EloquentRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
