<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;

class Article extends Model
{
    use LogsActivity;

    protected $table = 'articles';

    protected $dates = ['publish_date'];

    protected $fillable = ['title', 'resume', 'body', 'visible', 'tags', 'category_id'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function setPublishDateAttribute($value)
    {
        $this->attributes['publish_date'] = Carbon::createFromFormat('d-m-Y H:i', $value);
    }

    public function getPublishDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i');
    }

}

