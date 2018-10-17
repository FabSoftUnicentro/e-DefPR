<?php

namespace App\Http\Controllers\Api\Assisted;

use App\Http\Controllers\Controller;
use App\Models\Assisted;
use App\Http\Resources\Assisted as AssistedResource;

class AssistedList extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke()
    {
        $assisteds = Assisted::paginate($this->itemsPerPage);

        return AssistedResource::collection($assisteds);
    }
}
