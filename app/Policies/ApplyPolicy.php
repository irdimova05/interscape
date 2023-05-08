<?php

namespace App\Policies;

use App\Models\Apply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list.applies');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Apply  $apply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Apply $apply)
    {
        return $user->hasPermissionTo('show.apply');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('apply.ad');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Apply  $apply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Apply $apply)
    {
        return $user->hasPermissionTo('status.apply');
    }
}
