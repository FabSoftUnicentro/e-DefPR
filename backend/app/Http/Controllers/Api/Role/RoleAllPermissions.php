<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAllPermissions extends Controller
{
    /**
     * @param Role $role
     * @return mixed
     */
    public function __invoke(Role $role)
    {
        $permissions = Permission::all();
        $result = [];

        foreach ($permissions as $permission) {
            $result[] = [
                'id' => $permission->id,
                'name' => $permission->name,
                'chosen' => $role->hasPermissionTo($permission->id)
            ];
        }

        return JsonResponse::create($result);
    }
}
