<?php

namespace App\Helpers;

class Generate
{
    public static function randomString($length): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    public static function randomStringV2($length): string
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
}
