<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\Permission as PermissionResource;
use Illuminate\Support\Facades\Auth;

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
     * @param Request $request
     * @return PermissionResource|JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        try {
            $permission = Permission::create(['name' => $request->input('name')]);

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
     * @param Request $request
     * @param $id
     * @return PermissionResource|JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        try {
            /** @var Permission $permission */
            $permission = Permission::findOrFail($id);

            $permission->name = $request->input('name') ? $request->input('name') : $permission->name;
            $permission->guard_name = $request->input('guard_name') ? $request->input('guard_name') : $permission->guard_name;
            $permission->created_at = $request->input('created_at') ? $request->input('created_at') : $permission->created_at;
            $permission->updated_at = $request->input('updated_at') ? $request->input('updated_at') : $permission->updated_at;
            $permission->saveOrFail();

            return new PermissionResource($permission);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return PermissionResource|JsonResponse
     */
    public function destroy($id)
    {
        try {
            /** @var Permission $permission */
            $permission = Permission::findOrFail($id);

            $permission->delete();

            return new PermissionResource($permission);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
