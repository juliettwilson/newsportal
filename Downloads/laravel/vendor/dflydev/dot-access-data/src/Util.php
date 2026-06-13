<?php

declare(strict_types=1);


namespace Dflydev\DotAccessData;

class Util
{

    public static function isAssoc(array $arr): bool
    {
        return !count($arr) || count(array_filter(array_keys($arr), 'is_string')) == count($arr);
    }


    public static function mergeAssocArray($to, $from, int $mode = DataInterface::REPLACE)
    {
        if ($mode === DataInterface::MERGE && self::isList($to) && self::isList($from)) {
            return array_merge($to, $from);
        }

        if (is_array($from) && is_array($to)) {
            foreach ($from as $k => $v) {
                if (!isset($to[$k])) {
                    $to[$k] = $v;
                } else {
                    $to[$k] = self::mergeAssocArray($to[$k], $v, $mode);
                }
            }

            return $to;
        }

        return $mode === DataInterface::PRESERVE ? $to : $from;
    }

    private static function isList($value): bool
    {
        return is_array($value) && array_values($value) === $value;
    }
}
