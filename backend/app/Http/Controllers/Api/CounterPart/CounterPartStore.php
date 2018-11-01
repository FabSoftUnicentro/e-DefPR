<?php

namespace App\Http\Controllers\Api\CounterPart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounterPart\StoreRequest;
use App\Models\CounterPart;
use App\Http\Resources\CounterPart as CounterPartResource;

class CounterPartStore extends Controller
{
    /**
     * @param StoreRequest $request
     * @return CounterPartResource
     * @throws \Throwable
     */
    public function __invoke(StoreRequest $request)
    {
        /** @var CounterPart $counterPart */
        $counterPart = new CounterPart($request->all());

        $counterPart->saveOrFail();

        return new CounterPartResource($counterPart);
    }
}
