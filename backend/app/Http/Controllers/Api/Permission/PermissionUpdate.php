<?php

namespace App\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Permission\UpdateRequest;
use App\Http\Resources\Permission as PermissionResource;

class PermissionUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param Permission $permission
     * @return PermissionResource
     * @throws \Throwable
     */
    public function __invoke(UpdateRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        
        $permission->saveOrFail();

        return new PermissionResource($permission);
    }
}
