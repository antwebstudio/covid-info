<?php

namespace Addons\TagFieldtype\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Addons\TagFieldtype\Models\Tag;
use Fusion\Services\Builders\Extension as ExtensionBuilder;
use Fusion\Models\Extension;

class TagRequest extends FormRequest
{
    public function __construct()
    {
        // $this->model         = app(Tag::class)->make();
        $handle = 'tags';
        $this->model         = (new ExtensionBuilder($handle))->make();
        $extension = $this->model->extension ?? Extension::where(['handle' => $handle])->firstOrFail();

        $this->fieldset      = $extension->fieldset;
        $this->fields        = $this->fieldset->fields ?? [];
        $this->relationships = $this->fieldset ? $this->fieldset->relationships() : [];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('addon.tags.'.($this->method() === 'POST' ? 'create' : 'update'));
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $rules = [
        //     'slug'      => 'unique:'.$this->model->getTable().',slug,'.request()->id,
        // ];

        $rules['name'] = 'required';
        // $rules['slug'] .= '|required';

        $rules += $this->fields->flatMap(function ($field) {
            return $field->type()->rules($field, $this->{$field->handle});
        })->toArray();

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return $this->fields->flatMap(function ($field) {
            return $field->type()->attributes($field, $this->{$field->handle});
        })->toArray();
    }
}
