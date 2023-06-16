<?php

namespace App\Services;

use App\Models\AdStatus;
use App\Models\Favorite;

class FavoritesService
{
    public static function createFavorite($request)
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->isStudent()) {
            $student = $user->student;

            Favorite::firstOrCreate(
                ['student_id' => $student->id, 'ad_id' => $request->ad_id]
            );
        }
    }

    public static function getFavorites()
    {
        /** @var User $user */
        $user = auth()->user();
        if ($user->isStudent()) {
            return Favorite::where('student_id', $user->student->id)
                ->with('ad', 'ad.adStatus')
                ->whereHas('ad.adStatus', function ($q) {
                    $q->where('slug', AdStatus::ACTIVE);
                })
                ->paginate(10);
        }
    }
}
