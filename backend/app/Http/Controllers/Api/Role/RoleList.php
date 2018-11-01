<?php

namespace App\Http\Controllers\Api\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Resources\Role as RoleResource;

class RoleList extends Controller
{
    /** @var int */
    private $itemsPerPage = 10;

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request)
    {
        $paginate = intval($request->get('paginate', 1));

        if ($paginate === 1) {
            $roles = Role::paginate($this->itemsPerPage);
        } else {
            $roles= Role::all();
        }

        return RoleResource::collection($roles);
    }
}
