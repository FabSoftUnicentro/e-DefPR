<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Role\AssignPermissionRequest;
use App\Http\Requests\Role\UnassignPermissionRequest;
use Spatie\Permission\Guard;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;

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
     * @param StoreRequest $request
     * @return RoleResource|JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $role = Role::create($request->all());

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
     * @param UpdateRequest $request
     * @param $id
     * @return RoleResource|JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            /** @var Role $role */
            $role = Role::findOrFail($id);

            $role->update($request->all());

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
