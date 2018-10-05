<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Resources\City as CityResource;
use App\Http\Requests\City\StoreRequest;
use App\Http\Requests\City\UpdateRequest;

class CityController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $cities = City::orderBy('name', 'asc')->get();

        return CityResource::collection($cities);
    }

    /**
     * @param StoreRequest $request
     * @return CityResource|JsonResponse
     * @throws \Throwable
     */
    public function store(StoreRequest $request)
    {
        /** @var City $city */
        $city =  new City($request->all());

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
            if (!is_numeric($id)) {
                throw new \Exception($e);
            }
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
     * @param UpdateRequest $request
     * @param $id
     * @return CityResource|JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            /** @var City $city */
            $city = City::findOrFail($id);

            $city->update($request->all());

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
    public function findByState($id)
    {
        $cities = City::where('state_id', '=', $id)
                        ->orderBy('name', 'asc')
                        ->get();

        if ($cities) {
            return CityResource::collection($cities);
        }

        return JsonResponse::create([], Response::HTTP_NOT_FOUND);
    }
}
