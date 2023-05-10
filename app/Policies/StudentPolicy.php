<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
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
        return $user->hasPermissionTo('list.student');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Student $student)
    {
        return $user->hasPermissionTo('show.student');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Student $student)
    {
        //if users status is active deactivate it
        if ($user->status_id == Status::where('slug', 'active')->first()->id) {
            return $user->hasPermissionTo('deactivate.student');
        } else if ($user->status_id == Status::where('slug', 'inactive')->first()->id) {
            return $user->hasPermissionTo('activate.student');
        }
    }
}
