<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{

    use LogsActivity, HasTranslations;

    public $translatable = ['name', 'slug'];

    protected $fillable = ['category_type_id'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function category_type(){
        return $this->belongsTo(CategoryType::class);
    }
}
