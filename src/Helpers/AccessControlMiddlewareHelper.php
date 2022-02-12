<?php

namespace OZiTAG\Tager\Backend\Rbac\Helpers;

class AccessControlMiddlewareHelper
{
    private function prepare(...$items): string
    {
        $result = [];

        foreach ($items as $item) {
            if (is_string($item)) {
                $result[] = $item;
            } else if ($item instanceof \BackedEnum) {
                $result[] = $item->value;
            }
        }

        return implode(',', $result);
    }

    public function roles(...$ids): string
    {
        return 'roles:' . $this->prepare($ids);
    }

    public function allRoles(...$ids): string
    {
        return 'roles.all:' . $this->prepare($ids);
    }

    public function exceptRoles(...$ids): string
    {
        return 'roles.except:' . $this->prepare($ids);
    }

    public function scopes(...$scopes): string
    {
        return 'scopes:' . $this->prepare($scopes);
    }
}
