<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\ReportedAd;
use App\Models\Status;
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
     * @param  \App\Models\Ad  $reportedAd
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ad $ad)
    {
        if ($ad->is_reported) {
            return $user->hasPermissionTo('block.reported_ad') || $user->hasPermissionTo('release.reported_ad');
        }

        return false;
    }
}
