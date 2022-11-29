<?php

namespace App\Services;

use  GoogleTranslate;

class TranslateService
{
    public function translate($string, $idioma = 'pt')
    {

        if ($idioma == null) {
            return $string;
        }

        if ($idioma != 'pt') {
            $translate = GoogleTranslate::translate($string, $idioma, 'html');
            return $translate['translated_text'];
        }
        return $string;
    }
}
