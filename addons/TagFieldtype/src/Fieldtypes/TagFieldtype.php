<?php

namespace Addons\TagFieldType\Fieldtypes;

use Fusion\Models\Field;
use Addons\TagFieldtype\Http\Resources\TagResource;
use Illuminate\Support\Str;

class TagFieldtype extends \Fusion\Fieldtypes\Fieldtype
{
    /**
     * @var string
     */
    public $name = 'Tags';

    /**
     * @var string
     */
    public $icon = 'tags';

    /**
     * @var string
     */
    public $description = 'A field to add tags for your model';

    /**
     * @var string
     */

    public $relationship = 'morphToMany';

    public $traits = [
        \Spatie\Tags\HasTags::class,
    ];

    /**
     * @var array
     */
    public $settings = [
        'placeholder'           => '',
        'limit'                 => null,
        'root_directory'        => null,
        'filetype_restrictions' => [],
    ];

    public function generateRelationship($field)
    {
        // $namespace = $this->namespace.'\\'.Str::studly($model->handle);
        $tagType = $this->getTagType($field);
        $stub      = '
            public function {handle}()
            {
                return $this->morphToMany(self::getTagClassName(), "taggable"){where_clause}{order_clause};
            }
        ';

        return strtr($stub, [
            '{handle}'            => $field->handle,
            '{studly_handle}'     => Str::studly($field->handle),
            '{related_pivot_key}' => 'taxonomy_id',
            // '{related_namespace}' => $namespace,
            // '{related_table}'     => 'taggables',
            '{where_clause}'      => "->where('type', '{$tagType}')",
            '{order_clause}'      => "->orderBy('order_column')",
        ]);
    }

    public function persistRelationship($model, Field $field)
    {
        $oldValues = collect($model->tagsWithType($this->getTagType($field)))->pluck('name');
        $newValues = collect(request()->{$field->handle})->map(function($value) {
            return is_array($value) ? $value['name'] : $value;
        });
        $model->detachTags($oldValues, $this->getTagType($field));
        $model->attachTags($newValues, $this->getTagType($field));
    }

    public function getResource($model, Field $field)
    {
        // dd($this->getTagType($field), $model->tagsWithType($this->getTagType($field)));
        // dd(TagResource::collection($model->tagsWithType($this->getTagType($field)) ?? []));
       return TagResource::collection($model->tagsWithType($this->getTagType($field)) ?? []);
    }

    public function getTagType($field) {
        return $field->id.'-'.$field->handle;
    }
}
