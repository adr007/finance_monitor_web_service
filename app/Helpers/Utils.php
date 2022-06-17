<?php
namespace App\Helpers;

class Utils {
    public static function rupiah($number)
    {
        return number_format($number, 0, ',', '.');
    }
}