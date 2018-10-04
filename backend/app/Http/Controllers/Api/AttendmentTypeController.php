<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\AttendmentType;
use App\Http\Resources\AttendmentType as AttendmentTypeResource;
use App\Http\Requests\AttendmentType\StoreRequest;
use App\Http\Requests\AttendmentType\UpdateRequest;

class AttendmentTypeController extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $attendmentType = AttendmentType::paginate($this->itemsPerPage);

        return AttendmentTypeResource::collection($attendmentType);
    }

    /**
     * @param StoreRequest $request
     * @return AttendmentTypeResource|JsonResponse
     * @throws \Throwable
     */
    public function store(StoreRequest $request)
    {
        /** @var AttendmentType $attendmentType */
        $attendmentType =  new AttendmentType($request->all());

        try {
            $attendmentType->saveOrFail();

            return new AttendmentTypeResource($attendmentType);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @return AttendmentTypeResource|JsonResponse
     */
    public function show($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new \Exception();
            }
            /** @var AttendmentType $attendmentType */
            $attendmentType = AttendmentType::findOrFail($id);

            return new AttendmentTypeResource($attendmentType);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return AttendmentTypeResource|JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $id)
    {

        try {
            /** @var AttendmentType $attendmentType */
            $attendmentType = AttendmentType::findOrFail($id);

            $attendmentType->update($request->all());
            
            $attendmentType->saveOrFail();

            return new AttendmentTypeResource($attendmentType);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return AttendmentTypeResource|JsonResponse
     */
    public function destroy($id)
    {
        try {
            /** @var AttendmentType $attendmentType */
            $attendmentType = AttendmentType::findOrFail($id);

            $attendmentType->delete();

            return new AttendmentTypeResource($attendmentType);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
