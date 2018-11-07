<?php

namespace App\Http\Controllers\Api\Attendment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendment\UpdateRequest;
use App\models\Attendment;
use App\Http\Resources\Attendment as AttendmentResource;

class AttendmentUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param Attendment $attendment
     * @return AttendmentResource
     * @throws \Throwable
     */
    public function __invoke(UpdateRequest $request, Attendment $attendment)
    {
        $attendment->update($request->all());

        $attendment->saveOrFail();

        return new AttendmentResource($attendment);
    }
}
