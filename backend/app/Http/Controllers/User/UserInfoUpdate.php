<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;

class UserInfoUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @return UserResource
     */
    public function __invoke(UpdateRequest $request)
    {
        $user = Auth::user();

        $user->update($request->all());

        $user->saveOrFail();

        return new UserResource($user);
    }
}
