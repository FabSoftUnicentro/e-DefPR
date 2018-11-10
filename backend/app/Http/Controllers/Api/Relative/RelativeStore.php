<?php

namespace App\Http\Controllers\Api\Relative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Relative\StoreRequest;
use App\Models\Relative;
use App\Http\Resources\Relative as RelativeResource;

class RelativeStore extends Controller
{
    /**
     * @param StoreRequest $request
     * @return RelativeResource
     * @throws \Throwable
     */
    public function __invoke(StoreRequest $request)
    {
        /** @var Relative $assisted */
        $relative = new Relative($request->all());

        $relative->saveOrFail();

        return new RelativeResource($relative);
    }
}
