<?php

namespace OZiTAG\Tager\Backend\Rbac\Middlewares;

use Illuminate\Auth\AuthenticationException;
use OZiTAG\Tager\Backend\Rbac\Facades\UserAccessControl;

class CheckUserScopes
{
    /**
     * @param $request
     * @param $next
     * @param array $scopes
     * @return array
     * @throws AuthenticationException
     */
    public function handle($request, $next, ...$scopes)
    {
        $user = $request->user();
        if (!$user) {
            throw new AuthenticationException;
        }

        if(!UserAccessControl::checkUserScopes($scopes, $user)) {
            return response(['message' => 'Access denied'], 403);
        }

        return $next($request);
    }

}
