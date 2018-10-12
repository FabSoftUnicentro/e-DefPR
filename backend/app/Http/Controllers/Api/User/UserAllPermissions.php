<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;

class UserAllPermissions extends Controller
{
    /**
     * @param User $user
     * @return mixed
     */
    public function __invoke(User $user)
    {
        $permissions = Permission::all();
        $result = [];

        foreach ($permissions as $permission) {
            $result[] = [
                'id' => $permission->id,
                'name' => $permission->name,
                'chosen' => $user->hasPermissionTo($permission->id)
            ];
        }

        return JsonResponse::create($result);
    }
}
