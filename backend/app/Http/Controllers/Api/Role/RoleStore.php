<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Resources\Role as RoleResource;
use Spatie\Permission\Models\Role;

class RoleStore extends Controller
{
    /**
     * @param StoreRequest $request
     * @return RoleResource
     * @throws \Throwable
     */
    public function __invoke(StoreRequest $request)
    {
        $role = Role::create($request->all());

        $role->saveOrFail();

        return new RoleResource($role);
    }
}
