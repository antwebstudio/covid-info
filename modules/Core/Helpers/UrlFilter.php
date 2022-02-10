<?php
namespace Ant\Core\Helpers;

class UrlFilter {
    protected static $delimiter = ',';

    public static function isFilterOn($name, $id) {
        $request = request();
        $ids = explode(self::$delimiter, $request->query($name, ''));
        return in_array($id, $ids);
    }

    public static function mergeFilters($name, $filters) {
        return self::getQueryStringForId($name, $filters);
    }
	
	public static function addTo($name, $id) {
        $filters = self::getFilterForId($name, $id, true);
        $queryString = count($filters) ? implode(self::$delimiter, $filters) : null;
        return $queryString;
	}

    public static function getQueryStringForId($name, $id) {
        $filters = self::getFilterForId($name, $id);
        $queryString = count($filters) ? implode(self::$delimiter, $filters) : null;
        return $queryString;
    }
    
    public static function getFilter($name) {
        $request = request();
        $filters = $request->query($name);
        $filters = isset($filters) ? explode(self::$delimiter, $filters) : [];
        return $filters;
    }

    protected static function getFilterForId($name, $id, $alwaysAdd = false) {
        $filters = self::getFilter($name);
        $ids = collect($id)->toArray();
        
        foreach ($ids as $id) {
            if (($key = array_search($id, $filters)) !== false) {
                // ID already exist, remove it
				if (!$alwaysAdd) {
					unset($filters[$key]);
				}
            } else {
                // ID not exist, add it
                $filters[] = $id;
            }
        }
        return $filters;
    }
}
