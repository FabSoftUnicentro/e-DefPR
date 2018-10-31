<?php

namespace App\Http\Controllers\Api\City;

use App\Models\City;
use \App\Http\Resources\City as CityResource;
use App\Http\Controllers\Controller;

class CityFindByState extends Controller
{
    /**
     * @param $id
     * @return mixed
     */
    public function __invoke($id)
    {
        $cities = City::where('state_id', '=', $id)
            ->orderBy('name', 'asc')
            ->get();

        return CityResource::collection($cities);
    }
}
