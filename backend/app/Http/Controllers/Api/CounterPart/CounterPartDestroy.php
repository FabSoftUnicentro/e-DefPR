<?php

namespace App\Http\Controllers\Api\CounterPart;

use App\Http\Controllers\Controller;
use App\Models\CounterPart;
use App\Http\Resources\CounterPart as CounterPartResource;

class CounterPartDestroy extends Controller
{
    /**
     * @param CounterPart $counterPart
     * @return CounterPartResource
     * @throws \Exception
     */
    public function __invoke(CounterPart $counterPart)
    {
        $counterPart->delete();

        return new CounterPartResource($counterPart);
    }
}
