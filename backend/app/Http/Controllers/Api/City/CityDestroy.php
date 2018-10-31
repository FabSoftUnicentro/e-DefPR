<?php

namespace App\Http\Controllers\Api\City;

use App\Models\City;
use \App\Http\Resources\City as CityResource;
use App\Http\Controllers\Controller;

class CityDestroy extends Controller
{
    /**
     * @param City $city
     * @return CityResource
     * @throws \Exception
     */
    public function __invoke(City $city)
    {
        $city->delete();

        return new CityResource($city);
    }
}
