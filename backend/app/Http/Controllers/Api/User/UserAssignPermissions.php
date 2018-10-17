<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AssignPermissionRequest;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class UserAssignPermissions extends Controller
{
    /**
     * @param User $user
     * @param AssignPermissionRequest $request
     * @return UserResource
     */
    public function __invoke(User $user, AssignPermissionRequest $request)
    {
        /** User $user */
        $user->givePermissionTo($request->input('permissions'));

        return new UserResource($user);
    }
}
