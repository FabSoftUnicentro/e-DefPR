<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\Permission as PermissionResource;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;

class PermissionController extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $permissions = Permission::paginate($this->itemsPerPage);

        return PermissionResource::collection($permissions);
    }

    /**
     * @param StoreRequest $request
     * @return PermissionResource|JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $permission = Permission::create($request->all());

            return new PermissionResource($permission);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @return PermissionResource|JsonResponse
     */
    public function show($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new \Exception($e);
            }
            /** @var Permission $permission */
            $permission = Permission::findOrFail($id);

            return new PermissionResource($permission);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Permission $permission
     * @param UpdateRequest $request
     * @return PermissionResource
     * @throws \Throwable
     */
    public function update(Permission $permission, UpdateRequest $request)
    {
        $permission->update($request->all());
        $permission->saveOrFail();

        return new PermissionResource($permission);
    }

    /**
     * @param Permission $permission
     * @return PermissionResource
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return new PermissionResource($permission);
    }
}
