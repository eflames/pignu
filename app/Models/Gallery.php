<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = ['name', 'description'];


    public function details()
    {
        return $this->hasMany(GalleryDetail::class);
    }
}
