<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Plugin extends Model
{
    use LogsActivity;

    protected $table = 'plugins';

    protected $fillable = ['name', 'css_content', 'js_content', 'status'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;
}
