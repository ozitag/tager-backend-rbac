<?php

namespace OZiTAG\Tager\Backend\Rbac\Middlewares;

use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\Exceptions\MissingScopeException;
use OZiTAG\Tager\Backend\Rbac\Facades\Permissions;

class CheckUserScopes
{
    /**
     * @return array
     */
    public function handle($request, $next, ...$scopes)
    {
        $user = $request->user();
        if (!$user || !$user->token()) {
            throw new AuthenticationException;
        }

        if(!Permissions::checkUserScopes($scopes, $user)) {
            return response([
                'message' => 'Access denied'
            ], 403);
        }

        return $next($request);
    }

}
