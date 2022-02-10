<?php
namespace Addons\TagFieldtype\Models;

class Tag extends \Spatie\Tags\Tag {
    use \Fusion\Concerns\HasExtension;

    public function findWithSlug($slug, $locale = null) {
        $locale = $locale ?? app()->getLocale();

        return static::where("slug->{$locale}", $slug)->firstOrFail();
    }
}