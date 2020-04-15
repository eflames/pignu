<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use LogsActivity;

    protected $table = 'pages';

    protected $fillable = ['title', 'slug', 'content', 'seo_description', 'active'];

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    public function user()
    {
        return $this->hasOne(User::class, 'created_by', 'id');
    }

}

