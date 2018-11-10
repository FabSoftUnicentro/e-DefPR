<?php

namespace App\Http\Controllers\Api\Relative;

use App\Http\Controllers\Controller;
use App\Models\Relative;
use App\Http\Resources\Relative as RelativeResource;

class RelativeShow extends Controller
{
    /**
     * @param Relative $relative
     * @return RelativeResource
     */
    public function __invoke(Relative $relative)
    {
        return new RelativeResource($relative);
    }
}
