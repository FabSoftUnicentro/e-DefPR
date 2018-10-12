<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class UserUnassignRole extends Controller
{
    /**
     * @param User $user
     * @param $role
     * @return UserResource
     */
    public function __invoke(User $user, $role)
    {
        /** User $user */
        $user->removeRole($role);

        return new UserResource($user);
    }
}
