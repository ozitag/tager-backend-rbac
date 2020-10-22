<?php

namespace OZiTAG\Tager\Backend\Rbac\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Rbac\Models\AdministratorRole;

class AdministratorRoleRepository extends EloquentRepository
{
    public function __construct(AdministratorRole $model)
    {
        parent::__construct($model);
    }
}
