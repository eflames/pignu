<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }
    public function users(User $user) : bool{
        return $user->rol->p_users == 1 || $user->is_su == 1;
    }

    public function configs(User $user) : bool{
        return $user->rol->p_configs == 1 || $user->is_su == 1;
    }

    public function products(User $user) : bool{
        return $user->rol->p_products == 1 || $user->is_su == 1;
    }

    public function categories(User $user) : bool{
        return $user->rol->p_categories == 1 || $user->is_su == 1;
    }

    public function blog(User $user) : bool{
        return $user->rol->p_blog == 1 || $user->is_su == 1;
    }

    public function pages(User $user) : bool{
        return $user->rol->p_pages == 1 || $user->is_su == 1;
    }

    public function galleries(User $user) : bool{
        return $user->rol->p_galleries == 1 || $user->is_su == 1;
    }

    public function log(User $user) : bool{
        return $user->rol->p_log == 1 || $user->is_su == 1;
    }
    
    public function su(User $user) : bool{
        return $user->is_su == 1;
    }


}
