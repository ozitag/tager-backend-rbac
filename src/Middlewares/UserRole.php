<?php

namespace OZiTAG\Tager\Backend\Rbac\Middlewares;

use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\Exceptions\MissingScopeException;
use OZiTAG\Tager\Backend\Rbac\Facades\Role;

class UserRole
{
    /**
     * @return array
     */
    public function handle($request, $next, ...$roles)
    {
        $user = $request->user();
        if (!$user) {
            throw new AuthenticationException;
        }

        $appRole = Role::getUserRoleClass($user);

        foreach ($roles as $role) {
            if($appRole::getLabel() === $role) {
                return $next($request);
            }
        }

        return response([
            'message' => 'Access denied'
        ], 403);
    }

}
