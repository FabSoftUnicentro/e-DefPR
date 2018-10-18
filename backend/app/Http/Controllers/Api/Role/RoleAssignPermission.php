<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

class RoleAssignPermission extends Controller
{
    /**
     * @param Role $role
     * @param $permission
     * @return RoleResource
     */
    public function __invoke(Role $role, $permission)
    {
        $role->givePermissionTo($permission);

        return new RoleResource($role);
    }
}
