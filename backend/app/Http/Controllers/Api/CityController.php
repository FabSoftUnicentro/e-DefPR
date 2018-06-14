<?php
/**
 * Created by PhpStorm.
 * User: Jean Pierri
 * Date: 13/06/2018
 * Time: 21:52
 */

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Resources\City as CityResource;

class CityController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $cities = City::all();

        return CityResource::collection($cities);
    }

    /**
     * @param Request $request
     * @return CityResource|JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        /** @var City $city */
        $city =  new City();

        $city->name = $request->input('name');
        $city->state_id = $request->input('state_id');

        try {
            $city->saveOrFail();

            return new CityResource($city);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @return CityResource|JsonResponse
     */
    public function show($id)
    {
        try {
            /** @var City $city */
            $city = City::findOrFail($id);

            return new CityResource($city);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return CityResource|JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        try {
            /** @var City $city */
            $city = City::findOrFail($id);

            $city->name = $request->input('name') ? $request->input('name') : $city->name;
            $city->state_id = $request->input('state_id') ? $request->input('state_id') : $city->state_id;

            $city->saveOrFail();

            return new CityResource($city);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return CityResource|JsonResponse
     */
    public function destroy($id)
    {
        try {
            /** @var City $city */
            $city = City::findOrFail($id);

            $city->delete();

            return new CityResource($city);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public  function findByState($id)
    {
        $cities = City::where('state_id', '=', $id)->get();

        if ($cities) {
            return CityResource::collection($cities);
        }

        return JsonResponse::create([], Response::HTTP_NOT_FOUND);
    }
}