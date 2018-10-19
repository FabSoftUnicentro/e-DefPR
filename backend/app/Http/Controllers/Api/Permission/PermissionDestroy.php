<?php

namespace App\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\Permission as PermissionResource;

class PermissionDestroy extends Controller
{
    /**
     * @param Permission $permission
     * @return PermissionResource
     * @throws \Exception
     */
    public function __invoke(Permission $permission)
    {
        $permission->delete();

        return new PermissionResource($permission);
    }
}
