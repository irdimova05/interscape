<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->hasPermissionTo('list.user');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        return $user->hasPermissionTo('show.user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create.student') || $user->hasPermissionTo('create.employer');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function status(User $user, User $model)
    {

        if ($model->status_id === Status::where('slug', Status::ACTIVE)->first()->id) {
            return $user->hasPermissionTo('deactivate.student') || $user->hasPermissionTo('deactivate.employer');
        } else if ($model->status_id === Status::where('slug', Status::ACTIVE)->first()->id) {
            return $user->hasPermissionTo('activate.student') || $user->hasPermissionTo('activate.employer');
        }

        return false;
    }
}
