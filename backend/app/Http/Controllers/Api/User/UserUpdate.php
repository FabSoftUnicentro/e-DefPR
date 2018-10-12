<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Http\Resources\User as UserResource;

class UserUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return UserResource
     * @throws \Throwable
     */
    public function __invoke(UpdateRequest $request, User $user)
    {
        $user->update($request->all());

        $user->saveOrFail();

        return new UserResource($user);
    }
}
