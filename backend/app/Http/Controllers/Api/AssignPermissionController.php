<?php

namespace App\Http\Controllers\Api;

use \App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssignPermissionController extends Controller
{
    /**
     * @param Request $request
     * @return UserResource|JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        try {
            $user->givePermissionTo($request->input('permissions'));

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
