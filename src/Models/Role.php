<?php

namespace OZiTAG\Tager\Backend\Rbac\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package OZiTAG\Tager\Backend\Rbac\Models
 *
 * @property string $name
 * @property string scopes
 * @property bool $is_super_admin
 */
class Role extends Model
{
    use SoftDeletes;

    protected $table = 'tager_roles';

    public $fillable = [
        'name', 'scopes'
    ];

    public $guarded = [
        'is_super_admin'
    ];

    public static function getSuperAdminRoleId() : ?int {
        return self::whereIsSuperAdmin(true)->first()->id ?? null;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('is_super_admin', 'desc');
        });
    }
}
