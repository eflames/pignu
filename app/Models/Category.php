<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryType;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    protected $table = "categories";

    protected $fillable = ['name', 'type_id'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function type(){
        return $this->belongsTo(CategoryType::class,'type_id');
    }

    public static function categorySection($slug){
        $typeCat = CategoryType::where('slug', $slug)->first();
        $instance = new static;
        return $instance->where('type_id', $typeCat->id)->get();
    }
}
