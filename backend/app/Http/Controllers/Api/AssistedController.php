<?php

namespace App\Http\Controllers\Api;

use App\Models\Assisted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Assisted as assistedResource;
use Illuminate\Support\Facades\Auth;

class AssistedController extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $assisteds = Assisted::paginate($this->itemsPerPage);

        return AssistedResource::collection($assisteds);
    }

    /**
     * @param Request $request
     * @return AssistedResource|JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        /** @var Assisted $assisted */
        $assisted =  new Assisted();

        $assisted->name = $request->input('name');
        $assisted->email = $request->input('email');
        $assisted->cpf = $request->input('cpf');
        $assisted->birth_date = $request->input('birthDate');
        $assisted->rg = $request->input('rg');
        $assisted->rg_issuer = $request->input('rgIssuer');
        $assisted->gender = $request->input('gender');
        $assisted->marital_status = $request->input('maritalStatus');
        $assisted->addresses = json_encode($request->input('addresses'));
        $assisted->note = $request->input('note');
        $assisted->profession = $request->input('profession');
        //$assisted->counter_part = $request->input('counterPart');

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
     * @param $id
     * @return assistedResource|JsonResponse
     */
    public function show($id)
    {
        try {
            /** @var Assisted $assisted */
            $assisted = Assisted::findOrFail($id);

            return new AssistedResource($assisted);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return AssistedResource|JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        try {
            /** @var Assisted $assisted */
            $assisted = Assisted::findOrFail($id);

            $assisted->name = $request->input('name') ? $request->input('name') : $assisted->name;
            $assisted->email = $request->input('email') ? $request->input('email') : $assisted->email;
            $assisted->cpf = $request->input('cpf') ? $request->input('cpf') : $assisted->cpf;
            $assisted->birth_date = $request->input('birthDate') ? $request->input('birthDate') : $assisted->birth_date;
            $assisted->rg = $request->input('rg') ? $request->input('rg') : $assisted->rg;
            $assisted->rg_issuer = $request->input('rgIssuer') ? $request->input('rgIssuer') : $assisted->rg_issuer;
            $assisted->gender = $request->input('gender') ? $request->input('gender') : $assisted->gender;
            $assisted->marital_status = $request->input('maritalStatus') ? $request->input('maritalStatus') : $assisted->marital_status;
            $assisted->addresses = $request->input('addresses') ? json_encode($request->input('addresses')) : $assisted->addresses;
            $assisted->note = $request->input('note') ? $request->input('note') : $assisted->note;
            $assisted->profession = $request->input('profession') ? $request->input('profession') : $assisted->profession;
            //$assisted->counter_part = $request->input('counterPart') ? $request->input('counter_part') : $assisted->counter_part;
            $assisted->saveOrFail();

            return new AssistedResource($assisted);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return AssistedResource|JsonResponse
     */
    public function destroy($id)
    {
        try {
            /** @var Assisted $assisted */
            $assisted = Assisted::findOrFail($id);

            $assisted->delete();

            return new AssistedResource($assisted);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
