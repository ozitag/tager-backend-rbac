<?php

namespace OZiTAG\Tager\Backend\Rbac\Middlewares;

use Illuminate\Auth\AuthenticationException;
use OZiTAG\Tager\Backend\Rbac\Facades\UserAccessControl;

class UserRoles
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

        if(!UserAccessControl::checkUserRoles($roles, $user)) {
            return response(['message' => 'Access denied'], 403);
        }

        return $next($request);
    }

}
