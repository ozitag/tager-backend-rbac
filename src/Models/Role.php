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

    public function role()
    {
        return $this->hasMany(AdministratorRole::class);
    }
}
