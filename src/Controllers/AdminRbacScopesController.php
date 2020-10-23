<?php

namespace OZiTAG\Tager\Backend\Rbac\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\Rbac\TagerScopes;

class AdminRbacScopesController extends Controller
{
    public function index()
    {
        $scopes = TagerScopes::getScopes();

        $result = [];
        foreach ($scopes as $scopeGroup) {
            $result[] = [
                'name' => $scopeGroup['name'],
                'scopes' => $scopeGroup['scopes']
            ];
        }

        return new JsonResource($result);
    }
}
