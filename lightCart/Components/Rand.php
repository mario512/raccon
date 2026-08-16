<?php
class Rand
{
    public static function getRangeArr($count, $min, $max)
    {
        return array_map(
            function () use ($min, $max) {
                return rand($min, $max);
            },
            array_pad([], $count, 0)
        );
    }

    public static function getRand($data)
    {
        $explode = explode('-', $data);
        return rand($explode[0], $explode[1]);
    }
}
