<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserForgotPassword extends Controller
{
    /**
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function __invoke(ForgotPasswordRequest $request)
    {
        $email = $request->input('email');
        $cpf = $request->input('cpf');

        /** @var User $user */
        $user = User::where('email', '=', $email)
            ->where('cpf', '=', $cpf)
            ->first();

        if ($user) {
            try {
                $user->resetPassword();

                return JsonResponse::create([
                    'message' => 'User password resetted with success'
                ], Response::HTTP_OK);
            } catch (\Exception $e) {
                return JsonResponse::create([
                    'message' => $e->getMessage()
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return JsonResponse::create([
            'message' => 'User not found'
        ], Response::HTTP_NOT_FOUND);
    }
}
