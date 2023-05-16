<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
       return $user->hasRole('admin');
    }

    public function isAdmin(User $user):bool
    {
        return !$user->roles()->exists() || auth()->guest();
    }




}
