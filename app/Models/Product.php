<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'slug', 'description', 'active', 'highlighted', 'category_id', 'orderable'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','created_by');
    }


}

