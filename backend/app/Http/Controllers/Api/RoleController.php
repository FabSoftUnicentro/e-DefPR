<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Role\AssignPermissionRequest;
use App\Http\Requests\Role\UnassignPermissionRequest;
use Spatie\Permission\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Resources\Role as RoleResource;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $roles= Role::paginate($this->itemsPerPage);

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
            if (!is_numeric($id)) {
                throw new \Exception($e);
            }
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

    /**
     * @param $id
     * @param $permission
     * @return RoleResource|JsonResponse
     */
    public function assignPermission($id, $permission)
    {
        $role = Role::findOrFail($id);

        try {
            $role->givePermissionTo($permission);

            return new RoleResource($role);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Role $role
     * @param AssignPermissionRequest $request
     * @return RoleResource
     */
    public function assignPermissions(Role $role, AssignPermissionRequest $request)
    {
        $role->givePermissionTo($request->input('permissions'));
        return new RoleResource($role);
    }


    /**
     * @param $id
     * @param $permission
     * @return RoleResource|JsonResponse
     */
    public function unassignPermission($id, $permission)
    {
        $role = Role::findOrFail($id);

        try {
            $role->revokePermissionTo($permission);

            return new RoleResource($role);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function unassignPermissions(Role $role, UnassignPermissionRequest $request)
    {
        foreach ($request->input('permissions') as $permission) {
            $role->revokePermissionTo($permission);
        }
        return new RoleResource($role);
    }
}
