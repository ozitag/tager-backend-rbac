<?php

namespace OZiTAG\Tager\Backend\Rbac\Controllers;

use OZiTAG\Tager\Backend\Crud\Controllers\CrudController;
use OZiTAG\Tager\Backend\Rbac\Repositories\RoleRepository;
use OZiTAG\Tager\Backend\Rbac\Requests\RoleRequest;

class AdminRbacRolesController extends CrudController
{
    public function __construct(RoleRepository $repository)
    {
        parent::__construct($repository);

        $this->setResourceFields([
            'id',
            'name',
            'scopes' => function ($item) {
                if (!$item->scopes) {
                    return [];
                }

                $scopes = explode(',', $item->scopes);
                return array_map(function ($scope) {
                    return [
                        'value' => $scope,
                        'label' => 'Название скоупа',
                    ];
                }, $scopes);
            }
        ], true);

        $this->setStoreAndUpdateAction(RoleRequest::class, [
            'repository' => $repository,
            'fields' => [
                'name',
                'scopes' => function ($item) {
                    return $item ? implode(',', $item) : null;
                }
            ]
        ]);
    }
}
