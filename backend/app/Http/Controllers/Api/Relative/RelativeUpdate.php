<?php

namespace App\Http\Controllers\Api\Assisted;

use App\Http\Controllers\Controller;
use App\Http\Requests\Assisted\UpdateRequest;
use App\Models\Assisted;
use App\Http\Resources\Assisted as AssistedResource;

class AssistedUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param Assisted $assisted
     * @return AssistedResource
     * @throws \Throwable
     */
    public function __invoke(UpdateRequest $request, Assisted $assisted)
    {
        $assisted->update($request->all());

        $assisted->saveOrFail();

        return new AssistedResource($assisted);
    }
}
