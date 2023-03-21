<?php

namespace App\Services;

use App\Models\Apply;
use App\Models\User;

class ApplyService
{
    public static function getApplies($callback = null)
    {
        //if the user is employer show only applies of his own ads
        /** @var User $user */
        $user = auth()->user();
        $query = Apply::with(
            'user',
            'ad',
            'ad.employer',
            'user.student',
            'user.student.course',
            'user.student.specialty',
            'user.student.specialty.faculty.university'
        );

        if ($user->hasRole('employer')) {
            $query->whereHas('ad.employer', function ($query) use ($user) {
                $query->where('id', $user->employer->id);
            });
        }

        if ($callback) {
            $query = call_user_func($callback, $query);
        }

        return $query->paginate(10);
    }

    public static function createApply($request, $adId)
    {
        $path = $request->file('file')->store('applies');

        Apply::create([
            'folder_path' => $path,
            'description' => $request->description,
            'ad_id' => $adId,
            'user_id' => auth()->user()->id,
        ]);
    }

    //get ads of the logged employer
    public static function getAdsNames()
    {
        $user = auth()->user();
        $ads = $user->employer->ads()->pluck('title', 'id');
        return $ads;
    }
}
