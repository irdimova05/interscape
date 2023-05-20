<?php

namespace App\Http\Requests\Favorites;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class FavoritesStoreRequest extends MainFormRequest
{
    public function authorize()
    {
        return Gate::authorize('add.favorites');
    }

    public function rules()
    {
        return [
            'ad_id' => 'required|exists:ads,id',
        ];
    }
}