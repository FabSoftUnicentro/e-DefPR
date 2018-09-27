<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendment;

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
     * @param Request $request
     * @return AttendmentResource|JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request, $user_id)
    {
        /** @var Attendment $attendment */
        $attendment =  new Attendment();

        $attendment->description = $request->input('description');
        $attendment->type_id = $request->input('type_id');
        $attendment->user_id = $user_id;

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

            return new AttendmentResourse($attendment);
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
    public function update(Request $request, $id)
    {
        try {
            /** @var Attendment $attendment */
            $attendment = Attendment::findOrFail($id);

            $attendment->description = $request->input('description') ? $request->input('description') : $attendment->description;
            $attendment->type_id = $request->input('type_id') ? $request->input('type_id') : $attendment->type_id;

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