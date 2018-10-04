<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserAssignPermissionRequest;
use App\Http\Requests\UserAuthenticateRequest;
use App\Http\Requests\UserForgotPasswordRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUnassignPermissionRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @param UserAuthenticateRequest $request
     * @return JsonResponse
     */
    public function authenticate(UserAuthenticateRequest $request)
    {
        $data = $request->json()->all();

        $user = User::where('email', '=', $data['login'])
            ->orWhere('cpf', '=', $data['login'])
            ->first();

        if (!$user) {
            return JsonResponse::create([], Response::HTTP_NOT_FOUND);
        }

        if ($user && Hash::check($data['password'], $user->getAuthPassword())) {
            $token = $user->createToken('auth')->accessToken;

            return JsonResponse::create([
                'token' => $token,
                'name' => $user->name,
                'mustChangePassword' => $user->must_change_password
            ], Response::HTTP_OK);
        }

        return JsonResponse::create([], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = User::paginate($this->itemsPerPage);

        return UserResource::collection($users);
    }

    /**
     * @param UserStoreRequest $request
     * @return UserResource|JsonResponse
     * @throws \Throwable
     */
    public function store(UserStoreRequest $request)
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

    /**
     * @param $id
     * @return UserResource|JsonResponse
     */
    public function show($id)
    {
        try {
            if (is_numeric($id)) {
                /** @var User $user */
                $user = User::findOrFail($id);

                return new UserResource($user);
            }

            return JsonResponse::create([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return UserResource|JsonResponse
     * @throws \Throwable
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            /** @var User $user */
            $user = User::findOrFail($id);

            $user->update($request->all());

            $user->saveOrFail();

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return UserResource|JsonResponse
     */
    public function destroy($id)
    {
        try {
            /** @var User $user */
            $user = User::findOrFail($id);

            $user->delete();

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @return UserResource|JsonResponse
     */
    public function info()
    {
        try {
            $user = Auth::user();

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param UserForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(UserForgotPasswordRequest $request)
    {
        $email = $request->input('email');
        $cpf = $request->input('cpf');

        $user = User::where('email', '=', $email)
            ->where('cpf', '=', $cpf)
            ->first();

        if ($user) {
            try {
                $user->resetPassword();
    
                return JsonResponse::create([
                    'message' => 'User password reseted with success'
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

    /**
     * @param $id
     * @param $permission
     * @return UserResource|JsonResponse
     */
    public function assignPermission($id, $permission)
    {
        $user = User::findOrFail($id);

        try {
            $user->givePermissionTo($permission);

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @param UserAssignPermissionRequest $request
     * @return UserResource|JsonResponse
     */
    public function assignPermissions($id, UserAssignPermissionRequest $request)
    {
        $user = User::findOrFail($id);

        try {
            $user->givePermissionTo($request->input('permissions'));

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @param $permission
     * @return UserResource|JsonResponse
     */
    public function unassignPermission($id, $permission)
    {
        $user = User::findOrFail($id);

        try {
            $user->revokePermissionTo($permission);

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param User $user
     * @param UserUnassignPermissionRequest $request
     * @return UserResource|JsonResponse
     */
    public function unassignPermissions(User $user, UserUnassignPermissionRequest $request)
    {
        try {
            foreach ($request->input('permissions') as $permission) {
                $user->revokePermissionTo($permission);
            }

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @param $id
     * @param $role
     * @return UserResource|JsonResponse
     */
    public function assignRole($id, $role)
    {
        $user = User::findOrFail($id);

        try {
            $user->assignRole($role);

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @param $role
     * @return UserResource|JsonResponse
     */
    public function unassignRole($id, $role)
    {
        $user = User::findOrFail($id);

        try {
            $user->removeRole($role);

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function resetPassword(Request $request)
    {
        try {
            $user = User::findOrFail($request->user()->id);

            $user->password = $request->input('password');
            $user->must_change_password = false;

            $user->saveOrFail();
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function getAllPermissions(User $user, Request $request)
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

        return JsonResponse::create($result, Response::HTTP_OK);
    }
}
