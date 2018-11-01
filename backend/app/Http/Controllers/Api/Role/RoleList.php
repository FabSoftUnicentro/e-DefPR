<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

class RoleList extends Controller
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke()
    {
        $roles= Role::all();

        return RoleResource::collection($roles);
    }
}
