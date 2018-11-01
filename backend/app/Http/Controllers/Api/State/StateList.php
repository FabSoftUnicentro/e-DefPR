<?php

namespace App\Http\Controllers\Api\State;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Http\Resources\State as StateResource;

class StateList extends Controller
{
    /** @var int */


    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke()
    {
        $states = State::orderBy('abbr', 'asc')->get();

        return StateResource::collection($states);
    }
}
