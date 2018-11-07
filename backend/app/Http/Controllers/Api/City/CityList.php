<?php

namespace App\Http\Controllers\Api\City;

use App\Models\City;
use \App\Http\Resources\City as CityResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityList extends Controller
{
    /** @var int */
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request)
    {
        $paginate = intval($request->get('paginate', 1));

        if ($paginate === 1) {
            $cities = City::orderBy('name', 'asc')->paginate($this->itemsPerPage);
        } else {
            $cities = City::orderBy('name', 'asc')->get();
        }

        return CityResource::collection($cities);
    }
}
