<?php

namespace App\Http\Controllers;

use App\Http\Requests\Favorites\FavoritesDestroyRequest;
use App\Http\Requests\Favorites\FavoritesIndexRequest;
use App\Http\Requests\Favorites\FavoritesStoreRequest;
use App\Models\Favorite;
use App\Services\FavoritesService;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FavoritesIndexRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        if ($user->isStudent()) {
            $favorites = FavoritesService::getFavorites();
            return view('favorites.index', compact('favorites'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FavoritesStoreRequest $request)
    {
        FavoritesService::createFavorite($request);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoritesDestroyRequest $request, Favorite $favorite)
    {
        $favorite->delete();
        return redirect()->back();
    }
}
