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
        $query = Ad::with('employer', 'adStatus');

        $statuses = [
            AdStatus::ACTIVE,
        ];

        if ($user->hasRole('employer')) {
            $query->where('employer_id', $user->employer->id);

            array_push($statuses, AdStatus::INACTIVE, AdStatus::BLOCKED);
        } else if ($user->hasRole('admin')) {
            array_push($statuses, AdStatus::INACTIVE, AdStatus::BLOCKED);
        }

        $query->whereHas('adStatus', function ($q) use ($statuses) {
            $q->whereIn('slug', $statuses);
        });

        if ($callback) {
            $query = call_user_func($callback, $query);
        }

        return $query->paginate(10);
    }

    public static function applySearch($query, $search)
    {
        $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('id', $search)
            ->orWhereHas('employer', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });

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

    public static function updateStatus($ad, $adStatusSlug)
    {
        $adStatus = AdStatus::where('slug', $adStatusSlug)->firstOrFail()->id;
        $ad->ad_status_id = $adStatus;

        if ($adStatusSlug === AdStatus::BLOCKED) {
            $ad->is_reported = false;
        }

        $ad->save();
    }
}
