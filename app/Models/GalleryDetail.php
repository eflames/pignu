<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryDetail extends Model
{
    protected $table = 'gallery_details';

    public static function images($gallery_id){
        return self::where('gallery_id', '=', $gallery_id)->count();
    }
}
