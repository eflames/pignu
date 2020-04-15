<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    public function product(){
        return $this->belongsTo(Product::class,'product_id');

    }
    public static function images($product_id){
        return self::where('product_id', '=', $product_id)->count();
    }

}

