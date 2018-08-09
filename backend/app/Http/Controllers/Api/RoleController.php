<?php

namespace App\Http\Controllers\Api;

use Spatie\Permission\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Resources\Role as RoleResource;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $roles= Role::all();

        return RoleResource::collection($roles);
    }

    /**
     * @param Request $request
     * @return RoleResource|JsonResponse
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $guard_name = $request->input('guard_name') ? $request->input('guard_name') : Guard::getDefaultName(static::class);

        try {
            $role = Role::create([
                'name' => $name,
                'guard_name' => $guard_name
            ]);

            return new RoleResource($role);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @return RoleResource|JsonResponse
     */
    public function show($id)
    {
        try {
            /** @var Role $role */
            $role = Role::findOrFail($id);

            return new RoleResource($role);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return RoleResource|JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        try {
            /** @var Role $role */
            $role = Role::findOrFail($id);

            $role->name = $request->input('name') ? $request->input('name') : $role->name;
            $role->guard_name = $request->input('guard_name') ? $request->input('guard_name') : $role->guard_name;

            $role->saveOrFail();

            return new RoleResource($role);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return RoleResource|JsonResponse
     */
    public function destroy($id)
    {
        try {
            /** @var Role $role */
            $role = Role::findOrFail($id);

            $role->delete();

            return new RoleResource($role);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
