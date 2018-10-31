<?php

namespace App\Http\Controllers\Api\City;

use App\Models\City;
use \App\Http\Resources\City as CityResource;
use App\Http\Controllers\Controller;

class CityList extends Controller
{
    /** @var int */
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke()
    {
        $cities = City::orderBy('name', 'asc')->paginate($this->itemsPerPage);

        return CityResource::collection($cities);
    }
}
