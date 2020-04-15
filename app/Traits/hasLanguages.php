<?php

namespace App\Traits;

trait hasLanguages
{
    protected $appLanguages;

    public function __construct()
    {
        parent::__construct();
        $languages = \App\Models\AppLanguage::all();
        $this->appLanguages = $languages;
        view()->share('appLanguages', $languages);
    }
}