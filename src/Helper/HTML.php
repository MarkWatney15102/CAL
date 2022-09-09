<?php

namespace src\Helper;

class HTML
{
    public static function cleanString(string $string): string
    {
        $string = htmlentities(htmlspecialchars($string));

        return $string;
    }
}