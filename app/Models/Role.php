<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity;

    protected $table = "roles";

    protected $fillable = ['name', 'admin', 'p_blog', 'p_products', 'p_galleries', 'p_pages', 'p_categories', 'p_users', 'p_configs', 'p_log'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function users(){
        return $this->hasMany(User::class, 'rol_id');
    }
}
