<?php

namespace App\Policies;

use App\Models\Employer;
use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployerPolicy
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
        return $user->hasPermissionTo('list.employer');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Employer $employer)
    {
        return $user->hasPermissionTo('show.employer');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Employer $student)
    {
        //if users status is active deactivate it
        if ($user->status_id == Status::where('slug', 'active')->first()->id) {
            return $user->hasPermissionTo('deactivate.student');
        } else if ($user->status_id == Status::where('slug', 'inactive')->first()->id) {
            return $user->hasPermissionTo('activate.student');
        }
    }
}
