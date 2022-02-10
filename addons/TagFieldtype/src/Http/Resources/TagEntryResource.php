<?php

namespace Addons\TagFieldtype\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Fusion\Http\Resources\ExtensionResource;
use Addons\TagFieldtype\Http\Resources\TagResource;

class TagEntryResource extends JsonResource
{
    public function toArray($request)
    {
        $resource = [
            'extension' => new ExtensionResource($this->resource['extension']->extension),
            'entry' => new TagResource($this),
            // 'entry'  => [
            //     'id'         => $this->id,
            //     'name'       => $this->name,
            //     'slug'       => $this->slug,
            //     'created_at' => $this->created_at,
            //     'updated_at' => $this->updated_at,
            //     'status'     => $this->status,
            // ],
        ];

        if ($this->fields) {
            foreach ($this->fields as $field) {
                $resource['entry'][$field->handle] = $field->type()->getResource($this->resource, $field);
            }
        }

        return $resource;
    }
}