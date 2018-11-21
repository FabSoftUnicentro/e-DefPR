<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class UserUnassignPermission extends Controller
{
    /**
     * @param User $user
     * @param $permission
     * @return UserResource
     */
    public function __invoke(User $user, $permission)
    {
        /** User $user */
        $user->revokePermissionTo($permission);

        return new UserResource($user);
    }
}
