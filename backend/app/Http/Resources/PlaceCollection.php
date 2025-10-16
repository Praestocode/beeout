<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlaceCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => PlaceResource::collection($this->collection),
        ];
    }
}

?>
