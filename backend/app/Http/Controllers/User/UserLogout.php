<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserLogout extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->token()->revoke();

        return JsonResponse::create([
            'message' => 'Successfully logged out'
        ]);
    }
}
