<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class UserAssignPermission extends Controller
{
    /**
     * @param User $user
     * @param $permission
     * @return UserResource
     */
    public function __invoke(User $user, $permission)
    {
        /** User $user */
        $user->givePermissionTo($permission);

        return new UserResource($user);
    }
}
