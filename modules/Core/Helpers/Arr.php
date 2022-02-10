<?php
namespace Ant\Core\Helpers;

class Arr {
    public static function combinations($arrays, $i = 0)
    {
        if (!isset($arrays[$i]))
        {
            return [];
        }

        if ($i == count($arrays) - 1)
        {
            return $arrays[$i];
        }

        $tmp = self::combinations($arrays, $i + 1);

        $result = [];

        foreach ($arrays[$i] as $v)
        {
            foreach ($tmp as $t)
            {
                $result[] = is_array($t) ? array_merge([$v], $t) : [$v, $t];
            }
        }

        return $result;
    }
}
