<?php

namespace GTrader;

class Util
{
    /**
     * Time a call.
     * @param  Callable $callable
     * @return mixed
     */
    public static function time(Callable $callable)
    {
        $start = microtime(true);
        $return = $callable();
        dump('t = '.(microtime(true) - $start));
        return $return;
    }


    public static function ksortR(&$array, $sort_flags = SORT_REGULAR)
    {
        if (!is_array($array)) {
            return false;
        }
        ksort($array, $sort_flags);
        foreach ($array as &$val) {
            if (is_array($val)) {
                static::ksortR($val, $sort_flags);
            }
        }
        return true;
    }


    public static function logTrace()
    {
        Log::debug(self::backtrace());
    }


    public static function backtrace()
    {
        $e = new \Exception;
        return var_export($e->getTraceAsString(), true);
    }


    public static function humanBytes($bytes)
    {
        $unit = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2).$unit[$i];
    }


    public static function getMemoryUsage(bool $real_usage = false, bool $peak = false)
    {
        $func = $peak ? 'memory_get_peak_usage' : 'memory_get_usage';
        return self::humanBytes($func($real_usage));
    }


    public static function iterate(array $array, Callable $callback)
    {
        foreach ($array as $index => $value) {
            $callback($index, $value);
        }
        return;
    }


    /**
     * Returns the result of comparing $a to $b, using $cond
     * @param  mixed $a
     * @param  string $cond
     * @param  mixed $b
     * @return bool|null on error
     */
    public static function conditionMet($a, $cond, $b)
    {
        //dump('Util::conditionMet('.json_encode($a).', '.json_encode($cond).', '.json_encode($b).')');
        switch ($cond) {
            case '=':
            case '==':
            case 'eq':
                return $a == $b;

            case '===':
                return $a === $b;

            case '!':
            case '!=':
            case 'not':
                return $a != $b;

            case '!==':
                return $a !== $b;

            case '<':
            case 'lt':
                return $a < $b;

            case '<=':
            case 'lte':
                return $a <= $b;

            case '>':
            case 'gt':
                return $a > $b;

            case '>=':
            case 'gte':
                return $a >= $b;

            case '&&':
            case 'and':
                return $a && $b;

            case '||':
            case 'or':
                return $a || $b;

        }
        Log::error('Unknown condition: '. $cond);
        return null;
    }


    public static function toRGB($in): string
    {
        return '#'.substr(md5(strval($in)), 0, 6);
    }
}
