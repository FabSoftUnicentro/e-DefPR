<?php

namespace App\Http\Controllers\Api\CounterPart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounterPart\UpdateRequest;
use App\Models\CounterPart;
use App\Http\Resources\CounterPart as CounterPartResource;

class CounterPartUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param CounterPart $counterPart
     * @return CounterPartResource
     * @throws \Throwable
     */
    public function __invoke(UpdateRequest $request, CounterPart $counterPart)
    {
        $counterPart->update($request->all());

        $counterPart->saveOrFail();

        return new CounterPartResource($counterPart);
    }
}
