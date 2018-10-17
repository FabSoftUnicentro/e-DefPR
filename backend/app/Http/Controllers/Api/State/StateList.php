<?php

namespace App\Http\Controllers\Api\State;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Http\Resources\State as StateResource;

class StateList extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke()
    {
        $states = State::orderBy('abbr', 'asc')->paginate($this->itemsPerPage);

        return StateResource::collection($states);
    }
}
