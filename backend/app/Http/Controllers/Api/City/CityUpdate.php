<?php

namespace App\Http\Controllers\Api\City;

use App\Http\Requests\City\UpdateRequest;
use App\Models\City;
use \App\Http\Resources\City as CityResource;
use App\Http\Controllers\Controller;

class CityUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param City $city
     * @return CityResource
     * @throws \Throwable
     */
    public function __invoke(UpdateRequest $request, City $city)
    {
        $city->update($request->all());

        $city->saveOrFail();

        return new CityResource($city);
    }
}
