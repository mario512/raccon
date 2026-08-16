<?php

class StringFunctions
{

    public static function transLit($str)
    {
        $tr = array(
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
            "Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
            "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
            "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
            "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
            "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
            "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "yi", "ь" => "'", "э" => "e", "ю" => "yu", "я" => "ya",
            "." => "_", " " => "_", "?" => "_", "/" => "_", "\\" => "_",
            "*" => "_", ":" => "_", "*" => "_", "\"" => "_", "<" => "_",
            ">" => "_", "|" => "_"
        );
        return strtr($str, $tr);
    }

    public static function stripTags($fileName)
    {
        return strip_tags(html_entity_decode(mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $fileName), ENT_QUOTES, 'UTF-8'));
    }

    public static function formatPrice($price)
    {
        return number_format(round($price, 2), 2, '.', '');
    }
}
