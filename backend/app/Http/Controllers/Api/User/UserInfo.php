<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;

class UserInfo extends Controller
{
    /**
     * @return UserResource
     */
    public function __invoke()
    {
        return new UserResource(Auth::user());
    }
}
