<?php

namespace OZiTAG\Tager\Backend\Rbac\Helpers;

class AccessControlMiddlewareHelper {

    public function roles(...$ids) {
        return 'roles:' . implode(',', $ids);
    }

    public function allRoles(...$ids) {
        return 'roles.all:' . implode(',', $ids);
    }

    public function exceptRoles(...$ids) {
        return 'roles.except:' . implode(',', $ids);
    }

    public function scopes(...$scopes) {
        return 'scopes:' . implode(',', $scopes);
    }

}
