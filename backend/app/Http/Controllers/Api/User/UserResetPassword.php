<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserResetPassword extends Controller
{
    /**
     * @param ResetPasswordRequest $request
     * @return UserResource
     * @throws \Throwable
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->password = $request->input('password');
        $user->must_change_password = false;

        $user->saveOrFail();

        return new UserResource($user);
    }
}
