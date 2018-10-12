<?php

namespace App\Http\Controllers\Api\Assisted;

use App\Http\Controllers\Controller;
use App\Models\Assisted;
use App\Http\Resources\Assisted as AssistedResource;

class AssistedShow extends Controller
{
    /**
     * @param Assisted $assisted
     * @return AssistedResource
     */
    public function __invoke(Assisted $assisted)
    {
        return new AssistedResource($assisted);
    }
}
