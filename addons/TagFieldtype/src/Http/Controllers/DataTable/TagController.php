<?php
namespace Addons\TagFieldtype\Http\Controllers\DataTable;

use Illuminate\Http\Request;
use Addons\TagFieldtype\Models\Tag;
use Fusion\Http\Controllers\DataTableController;
use Addons\TagFieldtype\Http\Resources\TagCollection;
use Addons\TagFieldtype\Http\Resources\TagResource;

class TagController extends DataTableController {
    public function builder()
    {
        return Tag::query();
    }

    public function getDisplayableColumns()
    {
        return [
            'name',
            'slug',
            'created_at',
            'updated_at',
        ];
    }

    public function getFilterable()
    {
        return [
        ];
    }

    public function getSortable()
    {
        return [
            'id',
            'name',
            'slug',
            'created_at',
            'updated_at',
        ];
    }

    public function getCustomColumnNames()
    {
        return [
        ];
    }

    protected function getRecords(Request $request)
    {
        return new TagCollection(parent::getRecords($request));
    }
}