<?php

namespace Addons\TagFieldtype\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TagCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $resource = $this->resource->toArray();

        $resource['data'] = TagResource::collection($this->collection);

        return $resource;
    }
}