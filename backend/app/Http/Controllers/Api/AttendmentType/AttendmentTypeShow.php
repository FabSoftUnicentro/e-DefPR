<?php

namespace App\Http\Controllers\Api\AttendmentType;

use App\Models\AttendmentType;
use App\Http\Resources\AttendmentType as AttendmentTypeResource;
use App\Http\Controllers\Controller;

class AttendmentTypeShow extends Controller
{
    /**
     * @param AttendmentType $attendment
     * @return AttendmentTypeResource
     */
    public function __invoke(AttendmentType $attendmentType)
    {
        return new AttendmentTypeResource($attendmentType);
    }
}
