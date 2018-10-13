<?php

namespace App\Http\Controllers\Api\State;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Http\Resources\State as StateResource;

class StateDestroy extends Controller
{
    /**
     * @param State $state
     * @return StateResource
     * @throws \Exception
     */
    public function __invoke(State $state)
    {
        $state->delete();

        return new StateResource($state);
    }
}
