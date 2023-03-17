<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\AdStatus;
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
        $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('id', $search);

        return $query;
    }

    public static function createAd($data)
    {
        /** @var User $user */
        $user = auth()->user();
        $data['employer_id'] = $user->employer->id;
        $data['ad_status_id'] = AdStatus::where('slug', AdStatus::ACTIVE)->first()->id;
        $data['ad_category_id'] = $data['category'];
        unset($data['category']);
        $data['job_type_id'] = $data['jobType'];
        unset($data['jobType']);

        return Ad::create($data);
    }

    public static function updateAd($ad, $data)
    {
        $data['ad_category_id'] = $data['category'];
        unset($data['category']);
        $data['job_type_id'] = $data['jobType'];
        unset($data['jobType']);

        $ad->update($data);
    }
}
