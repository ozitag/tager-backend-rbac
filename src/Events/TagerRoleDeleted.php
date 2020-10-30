<?php

namespace OZiTAG\Tager\Backend\Rbac\Events;


class TagerRoleDeleted
{
    protected int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getRoleId(): int {
        return $this->id;
    }
}
