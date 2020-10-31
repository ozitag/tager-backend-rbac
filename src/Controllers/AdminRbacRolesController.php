<?php

namespace OZiTAG\Tager\Backend\Rbac\Controllers;

use OZiTAG\Tager\Backend\Crud\Actions\DeleteAction;
use OZiTAG\Tager\Backend\Crud\Actions\StoreOrUpdateAction;
use OZiTAG\Tager\Backend\Crud\Controllers\CrudController;
use OZiTAG\Tager\Backend\Rbac\Jobs\CheckIfCanDeleteRoleJob;
use OZiTAG\Tager\Backend\Rbac\Repositories\RoleRepository;
use OZiTAG\Tager\Backend\Rbac\Requests\RoleRequest;
use OZiTAG\Tager\Backend\Rbac\TagerScopes;

class AdminRbacRolesController extends CrudController
{
    public function __construct(RoleRepository $repository)
    {
        parent::__construct($repository);

        $this->setResourceFields([
            'id',
            'name',
            'isSuperAdmin' => 'is_super_admin:boolean',
            'scopes' => function ($item) {

                if ($item->is_super_admin) {
                    return ['*'];
                }

                if (!$item->scopes) {
                    return [];
                }

                $scopes = explode(',', $item->scopes);

                $scopes = array_filter($scopes, function ($scope) {
                    return TagerScopes::isScopeExists($scope);
                });

                return array_map(function ($scope) {
                    return [
                        'value' => $scope,
                        'label' => TagerScopes::getScopeLabel($scope),
                        'module' => TagerScopes::getScopeModule($scope)
                    ];
                }, $scopes);
            }
        ], true);

        $this->setStoreAndUpdateAction(new StoreOrUpdateAction(RoleRequest::class, null, [
            'repository' => $repository,
            'fields' => [
                'name',
                'scopes' => function ($item) {
                    return $item ? implode(',', $item) : null;
                }
            ]
        ]));

        $this->setDeleteAction(new DeleteAction(CheckIfCanDeleteRoleJob::class));
    }
}
