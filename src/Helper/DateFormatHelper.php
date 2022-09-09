<?php

namespace src\Helper;

use DateTime;
use Exception;

class DateFormatHelper
{
    public static function format(string $date, string $format = 'd.m.Y'): string
    {
        if (empty($format)) {
            throw new Exception('Invalid format for date');
        }

        try {
            $date = new DateTime($date);
        } catch (Exception $e) {
            $date = new DateTime();
        }

        return $date->format($format);
    }
}