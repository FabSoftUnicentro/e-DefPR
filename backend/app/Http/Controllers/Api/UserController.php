<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Auth;
use App\Services\Mailer;

class UserController extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function authenticate(Request $request)
    {
        $data = $request->json()->all();

        $user = User::where('email', '=', $data['login'])
            ->orWhere('cpf', '=', $data['login'])
            ->first();
            
        if ($user && Hash::check($data['password'], $user->getAuthPassword())) {
            $token = $user->createToken('auth')->accessToken;

            return JsonResponse::create([
                'token' => $token,
                'name' => $user->name,
                'mustChangePassword' => $user->must_change_password
            ], Response::HTTP_OK);
        }

        return JsonResponse::create([], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = User::paginate($this->itemsPerPage);

        return UserResource::collection($users);
    }

    /**
     * @param Request $request
     * @return UserResource|JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user =  new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->cpf = $request->input('cpf');
        $user->birth_date = $request->input('birthDate');
        $user->rg = $request->input('rg');
        $user->rg_issuer = $request->input('rgIssuer');
        $user->gender = $request->input('gender');
        $user->marital_status = $request->input('maritalStatus');
        $user->addresses = json_encode($request->input('addresses'));
        $user->note = $request->input('note');
        $user->profession = $request->input('profession');
        $user->must_change_password = $request->input('mustChangePassword') ? $request->input('mustChangePassword') : true;

        try {
            $user->saveOrFail();

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param $id
     * @return UserResource|JsonResponse
     */
    public function show($id)
    {
        try {
            /** @var User $user */
            $user = User::findOrFail($id);

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return UserResource|JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        try {
            /** @var User $user */
            $user = User::findOrFail($id);

            $user->name = $request->input('name') ? $request->input('name') : $user->name;
            $user->email = $request->input('email') ? $request->input('email') : $user->email;
            $user->password = $request->input('password') ? Hash::make($request->input('password')) : $user->password;
            $user->cpf = $request->input('cpf') ? $request->input('cpf') : $user->cpf;
            $user->birth_date = $request->input('birthDate') ? $request->input('birthDate') : $user->birth_date;
            $user->rg = $request->input('rg') ? $request->input('rg') : $user->rg;
            $user->rg_issuer = $request->input('rgIssuer') ? $request->input('rgIssuer') : $user->rg_issuer;
            $user->gender = $request->input('gender') ? $request->input('gender') : $user->gender;
            $user->marital_status = $request->input('maritalStatus') ? $request->input('maritalStatus') : $user->marital_status;
            $user->addresses = $request->input('addresses') ? json_encode($request->input('addresses')) : $user->addresses;
            $user->note = $request->input('note') ? $request->input('note') : $user->note;
            $user->profession = $request->input('profession') ? $request->input('profession') : $user->profession;
            $user->must_change_password = $request->input('mustChangePassword') ? $request->input('mustChangePassword') : true;

            $user->saveOrFail();

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $id
     * @return UserResource|JsonResponse
     */
    public function destroy($id)
    {
        try {
            /** @var User $user */
            $user = User::findOrFail($id);

            $user->delete();

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @return UserResource|JsonResponse
     */
    public function info()
    {
        try {
            $user = Auth::user();

            return new UserResource($user);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        try {
            $email = $request->input('email');
            $cpf = $request->input('cpf');

            $user = User::where('email', '=', $email)
                ->where('cpf', '=', $cpf)
                ->first();

            $temporaryPassword = uniqid(time());

            $user->forgotPassword($temporaryPassword);

            $address = [
                'email' => $user->email,
                'name' => $user->name
            ];

            Mailer::sendEmail([ $address ], 'Troca de Senha', $user->password);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
