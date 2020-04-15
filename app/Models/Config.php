<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Config extends Model
{
    use LogsActivity;

    protected $table = 'configs';

    protected $fillable = ['key', 'value', 'description'];

    public $translatable = ['value'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public static function setVar($key, $value)
    {
        static::where('key', $key)->update(['value' => $value]);
    }
}
