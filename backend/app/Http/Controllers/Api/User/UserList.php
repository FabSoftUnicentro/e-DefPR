<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;

class UserList extends Controller
{
    private $itemsPerPage = 10;

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke()
    {
        $users = User::paginate($this->itemsPerPage);

        return UserResource::collection($users);
    }
}
