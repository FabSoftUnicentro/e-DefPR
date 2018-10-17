<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

class RoleDestroy extends Controller
{
    /**
     * @param Role $role
     * @return RoleResource
     * @throws \Exception
     */
    public function __invoke(Role $role)
    {
        $role->delete();

        return new RoleResource($role);
    }
}
