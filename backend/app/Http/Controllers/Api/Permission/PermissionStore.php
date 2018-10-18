<?php

namespace App\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Resources\Permission as PermissionResource;

class PermissionStore extends Controller
{
    /**
     * @param StoreRequest $request
     * @return PermissionResource
     */
    public function __invoke(StoreRequest $request)
    {
        $permission = Permission::create($request->all());

        return new PermissionResource($permission);
    }
}
