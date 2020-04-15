<?php

namespace App\Services;

use App\Models\AppLanguage;

class AppLanguageService
{

    public static function getLanguages()
    {
        return AppLanguage::all();
    }

}