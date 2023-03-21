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
        $query = Apply::with('user', 'ad');

        if ($user->hasRole('employer')) {
            $query->whereHas('ad', function ($q) use ($user) {
                $q->where('employer_id', $user->employer->id);
            });
        }

        if ($callback) {
            $query = call_user_func($callback, $query);
        }

        return $query->paginate(10);
    }

    public static function createApply($data)
    {
        $apply = Apply::create([
            'folder_path' => $data['folder_path'],
            'description' => $data['description'],
        ]);

        $apply->user()->associate($data['user_id']);
        $apply->ad()->associate($data['ad_id']);

        $apply->save();

        return $apply;
    }
}
