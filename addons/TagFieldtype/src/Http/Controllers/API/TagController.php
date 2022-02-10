<?php
namespace Addons\TagFieldtype\Http\Controllers\API;

use Fusion\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Addons\TagFieldtype\Models\Tag;
use Addons\TagFieldtype\Http\Requests\TagRequest;
use Addons\TagFieldtype\Http\Resources\TagResource;
use Addons\TagFieldtype\Http\Resources\TagEntryResource;

class TagController extends Controller {
    /**
     * Display the specified resource.
     *
     * @param string $matrix
     *
     * @return JsonResponse
     */
    public function index()
    {
        $this->authorize('addon.tag.viewAny');

        $model = app(Tag::class);
        $entries = $model->paginate(25);

        return TagResource::collection($entries);
    }

    /**
     * Display the specified resource.
     *
     * @param \Fusion\Models\Matrix $matrix
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('addon.tag.view');

        $model = app(Tag::class);
        $entry  = $model->findOrFail($id);

        return new TagEntryResource($entry);
    }

    /**
     * Store newly created record in storage.
     *
     * @param \Illuminate\Http\Request                $request
     * @param string                                  $matrixSlug
     *
     * @return \Addons\TagFieldtype\Http\Resources\TagResource
     */
    public function store(Request $request)
    {
        $entry  = $request->model->create($request->validated());
        $matrix = $request->matrix;

        // persist relationships..
        foreach ($request->relationships as $relationship) {
            $relationship->type()->persistRelationship($entry, $relationship);
        }

        // Autogenerate name/slug
        if (!$matrix->show_name_field) {
            $entry->name = $this->compileBladeString($matrix->name_format, $entry);
            $entry->slug = Str::slug($entry->name);

            $entry->save();
        }

        return new TagResource($entry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request                $request
     * @param string                                  $matrix
     * @param int                                     $id
     *
     * @return \Addons\TagFieldtype\Http\Resources\TagResource
     */
    public function update(TagRequest $request, $id)
    {
        // $matrix = $request->matrix;
        $model = app(Tag::class);
        $entry  = $model->findOrFail($id);
        $entry->extension->update($request->validated());

        // persist relationships..
        foreach ($request->relationships as $relationship) {
            $relationship->type()->persistRelationship($entry->extension, $relationship);
        }

        // $entry->save();

        return new TagResource($entry);
    }

    /**
     * Destroy resource from storage.
     *
     * @param Request $request
     * @param string  $matrixSlug
     * @param int     $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $this->authorize('addon.tag.destroy');

        $model = app(Tag::class);   
        // $matrix = Matrix::where('slug', $matrixSlug)->firstOrFail();
        $entry  = $model->findOrFail($id);

        // if (isset($matrix->fieldset)) {
        //     foreach ($matrix->fieldset->relationships() as $relationship) {
        //         fieldtypes()->get($relationship->type)->destroyRelationship($entry, $relationship);
        //     }
        // }

        $entry->delete();
    }
}