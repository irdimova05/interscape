<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterestsPolicy
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
        return $user->hasPermissionTo('list.interests');
    }

    public function create(User $user)
    {
        $user = auth()->user();

        if ($user->isEmployer()) {
            return $user->hasPermissionTo('student.interest');
        } else if ($user->isStudent()) {
            return $user->hasPermissionTo('employer.interest');
        }

        return false;
    }
}
