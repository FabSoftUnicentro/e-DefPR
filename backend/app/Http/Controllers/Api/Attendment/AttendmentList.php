<?php

namespace App\Http\Controllers\Api\Attendment;

use App\Http\Controllers\Controller;
use App\Models\Attendment;
use App\Http\Resources\Attendment as AttendmentResource;

class AttendmentList extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke()
    {
        $attendment = Attendment::paginate($this->itemsPerPage);

        return AttendmentResource::collection($attendment);
    }
}
