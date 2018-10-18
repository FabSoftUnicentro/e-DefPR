<?php

namespace App\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\Permission as PermissionResource;

class PermissionShow extends Controller
{
    /**
     * @param Permission $permission
     * @return PermissionResource
     */
    public function __invoke(Permission $permission)
    {
        return new PermissionResource($permission);
    }
}
