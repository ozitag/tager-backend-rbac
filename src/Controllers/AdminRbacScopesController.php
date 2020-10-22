<?php

namespace OZiTAG\Tager\Backend\Rbac\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Controllers\Controller;

class AdminRbacScopesController extends Controller
{
    public function index()
    {
        return new JsonResource([
            [
                'value' => 'pages.edit',
                'label' => 'Редактирование страниц'
            ],
            [
                'value' => 'pages.create',
                'label' => 'Создание страниц'
            ],
            [
                'value' => 'users.management',
                'label' => 'Редактирование пользователей'
            ]
        ]);
    }
}
