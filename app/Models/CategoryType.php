<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    protected $table = "category_types";


    public function categoria(){
        return $this->hasMany(Category::class);
    }
}