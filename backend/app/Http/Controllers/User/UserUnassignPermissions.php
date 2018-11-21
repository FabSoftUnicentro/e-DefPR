<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UnassignPermissionRequest;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class UserUnassignPermissions extends Controller
{
    /**
     * @param User $user
     * @param UnassignPermissionRequest $request
     * @return UserResource
     */
    public function __invoke(User $user, UnassignPermissionRequest $request)
    {
        foreach ($request->input('permissions') as $permission) {
            $user->revokePermissionTo($permission);
        }

        return new UserResource($user);
    }
}
