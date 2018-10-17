<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

class RoleUnassignPermission extends Controller
{
    public function __invoke(Role $role, $permission)
    {
        $role->revokePermissionTo($permission);

        return new RoleResource($role);
    }
}
