<?php

namespace App\Http\Controllers\Api\State;

use App\Http\Controllers\Controller;
use App\Http\Requests\State\StoreRequest;
use App\Http\Resources\State as StateResource;
use App\Models\State;

class StateStore extends Controller
{
    /**
     * @param StoreRequest $request
     * @return StateResource
     * @throws \Throwable
     */
    public function __invoke(StoreRequest $request)
    {
        /** @var State $state */
        $state = new State($request->all());

        $state->saveOrFail();

        return new StateResource($state);
    }
}
