<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

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
        if ($user->id === $model->id) {
            return true;
        }

        if ($model->isEmployer()) {
            return $user->hasPermissionTo('show.employer');
        } else if ($model->isStudent()) {
            return $user->hasPermissionTo('show.student');
        }

        return false;
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
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        if ($user->isAdmin() || $user->id === $model->id) {
            return true;
        }
        return $user->hasPermissionTo('edit.profile');
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
        } else if ($model->status_id === Status::where('slug', Status::INACTIVE)->first()->id) {
            return $user->hasPermissionTo('activate.student') || $user->hasPermissionTo('activate.employer');
        }



        return false;
    }
}
