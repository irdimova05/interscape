<?php

namespace App\Services;

use App\Models\Favorites;

class FavoritesService
{
    public static function createFavorite($request)
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->isStudent()) {
            $student = $user->student;

            Favorites::firstOrCreate(
                ['student_id' => $student->id, 'ad_id' => $request->ad_id]
            );
        }
    }

    public static function getFavorites()
    {
        /** @var User $user */
        $user = auth()->user();
        if ($user->isStudent()) {
            return Favorites::where('student_id', $user->student->id)
                ->with('ad')
                ->paginate(10);
        }
    }
}
