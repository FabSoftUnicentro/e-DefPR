<?php

namespace App\Http\Controllers\Api\City;

use App\Http\Requests\City\StoreRequest;
use App\Models\City;
use \App\Http\Resources\City as CityResource;
use App\Http\Controllers\Controller;

class CityStore extends Controller
{
    /**
     * @param StoreRequest $request
     * @return CityResource
     * @throws \Throwable
     */
    public function __invoke(StoreRequest $request)
    {
        $city = new City($request->all());

        $city->saveOrFail();

        return new CityResource($city);
    }
}
