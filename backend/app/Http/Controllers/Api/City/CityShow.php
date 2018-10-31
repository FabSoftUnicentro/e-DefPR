<?php

namespace App\Http\Controllers\Api\City;

use App\Models\City;
use App\Http\Resources\City as CityResource;
use App\Http\Controllers\Controller;

class CityShow extends Controller
{
    /**
     * @param City $city
     * @return CityResource
     */
    public function __invoke(City $city)
    {
        return new CityResource($city);
    }
}
