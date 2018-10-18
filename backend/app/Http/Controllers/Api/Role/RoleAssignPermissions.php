<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\AssignPermissionRequest;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

class RoleAssignPermissions extends Controller
{
    /**
     * @param Role $role
     * @param AssignPermissionRequest $request
     * @return RoleResource
     */
    public function __invoke(Role $role, AssignPermissionRequest $request)
    {
        $role->givePermissionTo($request->input('permissions'));

        return new RoleResource($role);
    }
}
