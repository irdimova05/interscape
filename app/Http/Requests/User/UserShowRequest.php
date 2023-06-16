<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Common\MainGetRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Route;

class UserShowRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('show.user', [User::find(Route::current()->user)]);
    }
}
