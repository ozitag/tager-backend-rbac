<?php

use Illuminate\Support\Facades\Route;

use OZiTAG\Tager\Backend\Rbac\Controllers\AdminRbacScopesController;
use OZiTAG\Tager\Backend\Rbac\Controllers\AdminRbacRolesController;
use OZiTAG\Tager\Backend\Rbac\Enums\RbacScope;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControlMiddleware;

Route::group(['prefix' => 'admin/rbac', 'middleware' => ['passport:administrators', 'auth:api']], function () {

    Route::group(['prefix' => 'roles', 'middleware' => [AccessControlMiddleware::scopes(RbacScope::ViewRoles)]], function () {
        Route::get('/', [AdminRbacRolesController::class, 'index']);
        Route::get('{id}', [AdminRbacRolesController::class, 'view']);

        Route::group(['middleware' => [AccessControlMiddleware::scopes(RbacScope::EditRoles)]], function () {
            Route::post('/', [AdminRbacRolesController::class, 'store']);
            Route::put('{id}', [AdminRbacRolesController::class, 'update']);
            Route::delete('{id}', [AdminRbacRolesController::class, 'delete']);
        });
    });


    Route::get('/scopes', [AdminRbacScopesController::class, 'index']);
});
