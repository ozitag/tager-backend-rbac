<?php

use Illuminate\Support\Facades\Route;

use OZiTAG\Tager\Backend\Rbac\Controllers\AdminRbacScopesController;
use OZiTAG\Tager\Backend\Rbac\Controllers\AdminRbacRolesController;

Route::group(['prefix' => 'admin/rbac', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::apiResourceWithCount('/roles', AdminRbacRolesController::class);
    Route::get('/scopes', [AdminRbacScopesController::class, 'index']);
});
