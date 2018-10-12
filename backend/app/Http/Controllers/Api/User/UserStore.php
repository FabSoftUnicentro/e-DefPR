<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserStore extends Controller
{
    /**
     * @param StoreRequest $request
     * @return UserResource|JsonResponse
     * @throws \Throwable
     */
    public function __invoke(StoreRequest $request)
    {
        /** @var User $user */
        $user =  new User($request->all());

        try {
            $user->saveOrFail();

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}