<?php

namespace App\Http\Requests\Favorites;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class FavoritesIndexRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('list.favorites');
    }
}
