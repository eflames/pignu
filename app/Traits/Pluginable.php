<?php
/**
 * Created by PhpStorm.
 * User: noten
 * Date: 2/28/2020
 * Time: 9:30 PM
 */

namespace App\Traits;

use App\Models\Plugin;

trait Pluginable
{
    public function getPlugins()
    {
        return Plugin::where('active', 1)->get();
    }
}