<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

class RoleShow extends Controller
{
    /**
     * @param Role $role
     * @return RoleResource
     */
    public function __invoke(Role $role)
    {
        return new RoleResource($role);
    }
}
