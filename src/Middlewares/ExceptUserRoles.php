<?php

namespace OZiTAG\Tager\Backend\Rbac\Middlewares;

use Illuminate\Auth\AuthenticationException;
use OZiTAG\Tager\Backend\Rbac\Facades\UserAccessControl;

class ExceptUserRoles
{
    /**
     * @param $request
     * @param $next
     * @param array $roles
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws AuthenticationException
     */
    public function handle($request, $next, ...$roles)
    {
        $user = $request->user();
        if (!$user) {
            throw new AuthenticationException;
        }

        foreach ($roles as $role) {
            if(UserAccessControl::checkUserRole($role, $user)) {
                return response(['message' => 'Access denied'], 403);
            }
        }

        return $next($request);
    }

}
