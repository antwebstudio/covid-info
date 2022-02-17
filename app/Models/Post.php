<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Yurun\Util\Chinese;

class Post extends \Fusion\Models\Collections\Post
{
	public function getUrlAttribute()
	{
		return url('/p/'.$this->id.'?tags='.request()->tags);
	}
	
	public function scopeActive($query) 
	{
		$query->where('status', 1);
	}

    protected static function convertToTags($values, $type = null, $locale = null)
    {
        return collect($values)->map(function ($value) use ($type, $locale) {
            if ($value instanceof Tag) {
                if (isset($type) && $value->type != $type) {
                    throw new InvalidArgumentException("Type was set to {$type} but tag is of type {$value->type}");
                }

                return $value;
            }

            $className = static::getTagClassName();

			foreach (['zh', 'en'] as $locale) {
				$tag = $className::findFromString($value, $type, $locale);
				if (isset($tag)) return $tag;
			}
			
			$simplified = Chinese::toSimplified($value);
			$traditional = Chinese::toTraditional($value);
			if ($simplified[0] != $value) {
				$converted = $simplified[0];
			} else if ($traditional[0] != $value) {
				$converted = $traditional[0];
			} else {
				$converted = null;
			}
			if (isset($converted)) {
				$tag = $className::findFromString($converted, $type, 'zh');
				if (isset($tag)) return $tag;
			}
        });
    }

    public function morphTypeName()
	{
        return \Fusion\Models\Collections\Post::class;
    }
}