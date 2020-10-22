<?php

namespace OZiTAG\Tager\Backend\Rbac\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
