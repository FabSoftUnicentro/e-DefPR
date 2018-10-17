<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthenticateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserAuthenticate extends Controller
{
    /**
     * @param AuthenticateRequest $request
     * @return JsonResponse
     */
    public function __invoke(AuthenticateRequest $request)
    {
        $data = $request->json()->all();

        $user = User::where('email', '=', $data['login'])
            ->orWhere('cpf', '=', $data['login'])
            ->first();

        if (! $user) {
            return JsonResponse::create([], Response::HTTP_NOT_FOUND);
        }

        if ($user && Hash::check($data['password'], $user->getAuthPassword())) {
            $tokenResult = $user->createToken('auth');

            $token = $tokenResult->token;

            $token->save();

            return JsonResponse::create([
                'token' => $tokenResult->accessToken,
                'name' => $user->name,
                'mustChangePassword' => $user->must_change_password
            ], Response::HTTP_OK);
        }

        return JsonResponse::create([], Response::HTTP_UNAUTHORIZED);
    }
}
