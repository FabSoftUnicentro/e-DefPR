<?php

namespace App\Http\Controllers\Api;

use App\Models\State;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Resources\State as StateResource;
use App\Http\Requests\State\StoreRequest;
use App\Http\Requests\State\UpdateRequest;

class StateController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $states = State::orderBy('abbr', 'asc')->get();

        return StateResource::collection($states);
    }

    /**
     * @param StoreRequest $request
     * @return StateResource|JsonResponse
     * @throws \Throwable
     */
    public function store(StoreRequest $request)
    {
        /** @var State $state */
        $state =  new State();

        $state->name = $request->input('name');
        $state->abbr = $request->input('abbr');

        try {
            $state->saveOrFail();

            return new StateResource($state);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @return StateResource|JsonResponse
     */
    public function show($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new \Exception($e);
            }
            /** @var State $state */
            $state = State::findOrFail($id);

            return new StateResource($state);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return StateResource|JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            /** @var State $state */
            $state = State::findOrFail($id);

            $state->name = $request->input('name') ? $request->input('name') : $state->name;
            $state->abbr = $request->input('abbr') ? $request->input('abbr') : $state->abbr;

            $state->saveOrFail();

            return new StateResource($state);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return StateResource|JsonResponse
     */
    public function destroy($id)
    {
        try {
            /** @var State $state */
            $state = State::findOrFail($id);

            $state->delete();

            return new StateResource($state);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
