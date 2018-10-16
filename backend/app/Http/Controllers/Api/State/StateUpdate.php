<?php

namespace App\Http\Controllers\Api\State;

use App\Http\Controllers\Controller;
use App\Http\Requests\State\UpdateRequest;
use App\Http\Resources\State as StateResource;
use App\Models\State;

class StateUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param State $state
     * @return StateResource
     * @throws \Throwable
     */
    public function __invoke(UpdateRequest $request, State $state)
    {
        $state->update($request->all());

        $state->saveOrFail();

        return new StateResource($state);
    }
}
