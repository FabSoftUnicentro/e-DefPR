<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class UserAssignRole extends Controller
{
    /**
     * @param User $user
     * @param $role
     * @return UserResource
     */
    public function __invoke(User $user, $role)
    {
        /** User $user */
        $user->assignRole($role);

        return new UserResource($user);
    }
}
