<?php

namespace App\Http\Controllers\Api\Relative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Relative\UpdateRequest;
use App\Models\Relative;
use App\Http\Resources\Relative as RelativeResource;

class RelativeUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param Relative $relative
     * @return RelativeResource
     * @throws \Throwable
     */
    public function __invoke(UpdateRequest $request, Relative $relative)
    {
        $relative->update($request->all());

        $relative->saveOrFail();

        return new RelativeResource($relative);
    }
}
