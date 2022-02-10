<?php

namespace Addons\TagFieldtype\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        $resource = [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
            'type' => $this->resource->type,
            'order_column' => $this->resource->order_column,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'status' => 1,
        ];

        if (isset($this->resource['extension'])) {
            $fields = $this->resource['extension']->fieldset->fields;
        }

        if (isset($fields) && $fields) {
            foreach ($fields as $field) {
                $resource[$field->handle] = $this->resource->{$field->handle};
            }
        }

        return $resource;
    }
}