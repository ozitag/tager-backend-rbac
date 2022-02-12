<?php

namespace OZiTAG\Tager\Backend\Rbac;

use Illuminate\Support\ServiceProvider;
use OZiTAG\Tager\Backend\Rbac\Enums\RbacScope;
use OZiTAG\Tager\Backend\Rbac\Middlewares\CheckUserScopes;
use OZiTAG\Tager\Backend\Rbac\Middlewares\ExceptUserRoles;
use OZiTAG\Tager\Backend\Rbac\Middlewares\OneOfUserRoles;
use OZiTAG\Tager\Backend\Rbac\Middlewares\UserRoles;

class RbacServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('router')->aliasMiddleware('scopes', CheckUserScopes::class);
        app('router')->aliasMiddleware('roles', OneOfUserRoles::class);
        app('router')->aliasMiddleware('roles.all', UserRoles::class);
        app('router')->aliasMiddleware('roles.except', ExceptUserRoles::class);

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'tager-rbac');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        TagerScopes::registerGroup(__('tager-rbac::scopes.group'), [
            RbacScope::ViewRoles->value => __('tager-rbac::scopes.view_roles'),
            RbacScope::CreateRoles->value => __('tager-rbac::scopes.create_roles'),
            RbacScope::EditRoles->value => __('tager-rbac::scopes.edit_roles'),
            RbacScope::DeleteRoles->value => __('tager-rbac::scopes.delete_roles'),
        ]);
    }
}
