<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendment\StoreRequest;
use App\Http\Requests\Attendment\UpdateRequest;
use App\Models\Attendment;
use App\Http\Resources\Attendment as AttendmentResource;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AttendmentController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $attendment = Attendment::all();

        return AttendmentResource::collection($attendment);
    }

    /**
     * @param StoreRequest $request
     * @return AttendmentResource|JsonResponse
     * @throws \Throwable
     */
    public function store(StoreRequest $request)
    {
        /** @var Attendment $attendment */
        $attendment =  new Attendment($request->all());
        $user = Auth::user();

        $attendment->user_id = $user->getAuthIdentifier();

        try {
            $attendment->saveOrFail();

            return new AttendmentResource($attendment);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @return AttendmentResource|JsonResponse
     */
    public function show($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new \Exception($e);
            }
            /** @var Attendment $attendment */
            $attendment = Attendment::findOrFail($id);

            return new AttendmentResource($attendment);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return AttendmentResource|JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            /** @var Attendment $attendment */
            $attendment = Attendment::findOrFail($id);

            $attendment->update($request->all());

            $attendment->saveOrFail();

            return new AttendmentResource($attendment);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return AttendmentResource|JsonResponse
     */
    public function destroy($id)
    {
        try {
            /** @var Attendment $attendment */
            $attendment = Attendment::findOrFail($id);

            $attendment->delete();

            return new AttendmentResource($attendment);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
