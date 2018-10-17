<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\UnassignPermissionRequest;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

class RoleUnassignPermissions extends Controller
{
    /**
     * @param Role $role
     * @param UnassignPermissionRequest $request
     * @return RoleResource
     */
    public function __invoke(Role $role, UnassignPermissionRequest $request)
    {
        foreach ($request->input('permissions') as $permission) {
            $role->revokePermissionTo($permission);
        }

        return new RoleResource($role);
    }
}
