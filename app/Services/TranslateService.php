<?php

namespace App\Services;

use  GoogleTranslate;

class TranslateService
{

    public static function translate($string)
    {

        $idioma = request()->idioma;

        if ($idioma == null || $idioma == '') {
            return $string;
        }

        if ($idioma != 'pt') {
            $translate = GoogleTranslate::translate($string, $idioma, 'html');
            return $translate['translated_text'];
        }
        return $string;
    }
}
