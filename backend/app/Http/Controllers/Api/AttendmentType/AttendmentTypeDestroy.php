<?php

namespace App\Http\Controllers\Api\AttendmentType;

use App\Models\AttendmentType;
use App\Http\Resources\Attendment as AttendmentResource;
use App\Http\Controllers\Controller;

class AttendmentTypeDestroy extends Controller
{
    /**
     * @param AttendmentType $attendmentType
     * @return AttendmentResource
     * @throws \Exception
     */
    public function __invoke(AttendmentType $attendmentType)
    {
        $attendmentType->delete();

        return new AttendmentResource($attendmentType);
    }
}
