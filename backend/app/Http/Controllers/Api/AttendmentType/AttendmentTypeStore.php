<?php

namespace App\Http\Controllers\Api\AttendmentType;

use App\Http\Resources\AttendmentType as AttendmentTypeResource;
use App\Http\Requests\AttendmentType\StoreRequest;
use App\Models\AttendmentType;
use App\Http\Controllers\Controller;

class AttendmentTypeStore extends Controller
{
    /**
     * @param StoreRequest $request
     * @return AttendmentTypeResource
     * @throws \Throwable
     */
    public function __invoke(StoreRequest $request)
    {
        $attendmentType = new AttendmentType($request->all());

        $attendmentType->saveOrFail();

        return new AttendmentTypeResource($attendmentType);
    }
}
