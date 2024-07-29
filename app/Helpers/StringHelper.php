<?php

namespace App\Helpers;

class StringHelper
{
    public static function toSlug($string)
    {
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace('/[^\p{L}\p{N}\s-]/u', '', $string); // Giữ lại chữ cái, chữ số, khoảng trắng, và dấu gạch ngang
        $string = preg_replace('/[\s-]+/', '-', $string); // Thay thế khoảng trắng và dấu gạch ngang bằng một dấu gạch ngang
        $string = trim($string, '-');
        return $string;
    }
}
