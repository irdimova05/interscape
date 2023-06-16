<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\AdStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
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
        return $user->hasPermissionTo('list.ad');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Ad $ad)
    {
        return $user->hasPermissionTo('show.ad') || $user->id === $ad->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create.ad');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ad $ad)
    {
        return $user->hasPermissionTo('edit.ad') && $user->id === $ad->user_id;
    }

    /**
     * Determine whether the user can activate the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function status(User $user, Ad $ad)
    {
        if (($ad->ad_status_id === AdStatus::where('slug', AdStatus::ACTIVE)->first()->id && $user->employer->id === $ad->employer_id)) {
            return $user->hasPermissionTo('deactivate.ad');
        } else if (($ad->ad_status_id === AdStatus::where('slug', AdStatus::INACTIVE)->first()->id && $user->employer->id === $ad->employer_id)) {
            return $user->hasPermissionTo('activate.ad');
        } else if ($ad->ad_status_id === AdStatus::where('slug', AdStatus::BLOCKED)->first()->id) {
            return false;
        }
    }

    /**
     * Determine whether the user can report the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function report(User $user, Ad $ad)
    {
        return $user->hasPermissionTo('report.ad') && $user->id !== $ad->user_id;
    }

    /**
     * Determine whether the user can block the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function block(User $user, Ad $ad)
    {
        return $user->hasPermissionTo('block.ad') && $user->id !== $ad->user_id;
    }
}
