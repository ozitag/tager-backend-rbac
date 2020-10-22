<?php

namespace OZiTAG\Tager\Backend\Rbac;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Laravel\Passport\Passport;
use OZiTAG\Tager\Backend\Rbac\Helpers\Permissions;
use OZiTAG\Tager\Backend\Rbac\Helpers\Role;
use OZiTAG\Tager\Backend\Rbac\Middlewares\CheckUserScopes;
use OZiTAG\Tager\Backend\Rbac\Middlewares\UserRole;

class RbacServiceProvider extends EventServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'rbac'
        );

        $this->app->bind('permissions', function () {
            return new Permissions();
        });

        $this->app->bind('role', function () {
            return new Role();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('router')->aliasMiddleware('scopes', CheckUserScopes::class);
        app('router')->aliasMiddleware('roles', UserRole::class);

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
    }
}
