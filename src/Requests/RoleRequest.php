<?php

namespace OZiTAG\Tager\Backend\Rbac\Requests;

use OZiTAG\Tager\Backend\Crud\Requests\CrudFormRequest;

class RoleRequest extends CrudFormRequest
{
    public function rules()
    {
        $id = $this->route('id', 0);

        return [
            'name' => 'required|string|unique:tager_roles,name,' . $id,
            'scopes' => 'nullable|array',
            'scopes.*' => 'string'
        ];
    }
}
