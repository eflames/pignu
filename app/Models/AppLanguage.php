<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AppLanguage extends Model
{
    protected $table = 'app_languages';

    protected $fillable = ['iso', 'name', 'created_by'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function getNameAttribute($value)	 	 
    {	 	 
        return ucfirst($value);	 	 
    }
}