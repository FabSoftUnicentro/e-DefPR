<?php

namespace App\Http\Controllers\Api\Relative;

use App\Http\Controllers\Controller;
use App\Models\Relative;
use App\Http\Resources\Relative as RelativeResource;

class RelativeList extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke()
    {
        $relative = Relative::paginate($this->itemsPerPage);

        return RelativeResource::collection($relative);
    }
}
