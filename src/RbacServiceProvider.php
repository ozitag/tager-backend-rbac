<?php

namespace OZiTAG\Tager\Backend\Rbac;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use OZiTAG\Tager\Backend\Rbac\Middlewares\CheckUserScopes;
use OZiTAG\Tager\Backend\Rbac\Middlewares\ExceptUserRoles;
use OZiTAG\Tager\Backend\Rbac\Middlewares\OneOfUserRoles;
use OZiTAG\Tager\Backend\Rbac\Middlewares\UserRoles;

class RbacServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

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

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
    }
}
