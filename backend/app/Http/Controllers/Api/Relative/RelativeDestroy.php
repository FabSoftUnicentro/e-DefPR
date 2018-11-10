<?php

namespace App\Http\Controllers\Api\Relative;

use App\Http\Controllers\Controller;
use App\Models\Relative;
use App\Http\Resources\Relative as RelativeResource;

class RelativeDestroy extends Controller
{
    /**
     * @param Relative $relative
     * @return RelativeResource
     * @throws \Exception
     */
    public function __invoke(Relative $relative)
    {
        $relative->delete();

        return new RelativeResource($relative);
    }
}
