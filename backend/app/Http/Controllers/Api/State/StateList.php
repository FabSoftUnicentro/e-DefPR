<?php

namespace App\Http\Controllers\Api\State;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Http\Resources\State as StateResource;
use Illuminate\Http\Request;

class StateList extends Controller
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
            $states = State::orderBy('abbr', 'asc')->paginate($this->itemsPerPage);
        } else {
            $states = State::orderBy('abbr', 'asc')->get();
        }

        return StateResource::collection($states);
    }
}
