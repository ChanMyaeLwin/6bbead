<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Role extends Authenticatable
{
   use HasRoles;

    protected $fillable = [
        'name','guard_name'
    ];

    public function permissions() {

        return $this->belongsToMany(Permission::class,'role_has_permissions');
            
     }
}
