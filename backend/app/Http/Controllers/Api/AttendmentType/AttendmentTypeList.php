<?php

namespace App\Http\Controllers\Api\AttendmentType;

use App\Models\AttendmentType;
use App\Http\Resources\AttendmentType as AttendmentTypeResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendmentTypeList extends Controller
{
    /** @var int */
    private $itemsPerPage = 10;

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request)
    {
        $paginate = intval($request->get('paginate', 1));

        if ($paginate === 1) {
            $attendmentType = AttendmentType::orderBy('name', 'asc')->paginate($this->itemsPerPage);
        } else {
            $attendmentType = AttendmentType::orderBy('name', 'asc')->get();
        }

        return AttendmentTypeResource::collection($attendmentType);
    }
}
