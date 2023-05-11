<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class UserShowRequest extends MainGetRequest
{
    public function authorize()
    {
        Gate::authorize('show.user');
    }
}
