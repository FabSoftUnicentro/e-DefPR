<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Assisted\StoreRequest;
use App\Http\Requests\Assisted\UpdateRequest;
use App\Models\Assisted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Resources\Assisted as assistedResource;

class AssistedController extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        /** @var Assisted $assisteds */
        $assisteds = Assisted::paginate($this->itemsPerPage);
        return AssistedResource::collection($assisteds);
    }

    /**
     * @param StoreRequest $request
     * @return assistedResource|JsonResponse
     * @throws \Throwable
     */
    public function store(StoreRequest $request)
    {
        /** @var Assisted $assisted */
        $assisted =  new Assisted($request->all());

        try {
            $assisted->saveOrFail();

            return new assistedResource($assisted);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @return assistedResource|JsonResponse
     */
    public function show(Assisted $assisted)
    {
        return new AssistedResource($assisted);
    }

    /**
     * @param Assisted $assisted
     * @param UpdateRequest $request
     * @return assistedResource
     * @throws \Throwable
     */
    public function update(Assisted $assisted, UpdateRequest $request)
    {
        $assisted->update($request->all());
        $assisted->saveOrFail();
        return new AssistedResource($assisted);
    }

    /**
     * @param Assisted $assisted
     * @return assistedResource
     * @throws \Exception
     */
    public function destroy(Assisted $assisted)
    {
        $assisted->delete();
        return new AssistedResource($assisted);
    }
}
