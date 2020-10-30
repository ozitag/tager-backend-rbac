<?php

namespace OZiTAG\Tager\Backend\Rbac\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Rbac\Models\Role;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckIfCanDeleteRoleJob extends Job
{
    private Role $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function handle()
    {
        if ($this->model->is_super_admin) {
            throw new HttpException(403, 'Access Denied | You can not delete super admin role');
        }

        return true;
    }
}
