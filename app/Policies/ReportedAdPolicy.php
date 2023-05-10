<?php

namespace App\Policies;

use App\Models\ReportedAd;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportedAdPolicy
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
        return $user->hasPermissionTo('list.reported_ad');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('report.ad');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReportedAd  $reportedAd
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ReportedAd $reportedAd)
    {
        if ($reportedAd->status == 'pending') {
            return $user->hasPermissionTo('accept.reported_ad') || $user->hasPermissionTo('reject.reported_ad');
        }

        return false;
    }
}
