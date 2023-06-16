<?php

namespace App\Http\Requests\Favorites;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class FavoritesDestroyRequest extends MainFormRequest
{
    public function authorize()
    {
        return Gate::authorize('remove.favorites');
    }

    public function rules()
    {
        return [];
    }
}
