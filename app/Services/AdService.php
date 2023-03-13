<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\User;

class AdService
{
    public static function getAds($callback = null)
    {
        // if the user is employer show only his own ads
        /** @var User $user */
        $user = auth()->user();
        if ($user->hasRole('employer')) {
            $query = Ad::where('employer_id', $user->employer->id);
        } else {
            $query = Ad::with('employer');
        }

        if ($callback) {
            $query = call_user_func($callback, $query);
        }

        return $query->paginate(10);
    }

    public static function applySearch($query, $search)
    {
        $query->where('title', 'like', '%' . $search . '%');

        return $query;
    }
}
