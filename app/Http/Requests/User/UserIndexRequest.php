<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class UserIndexRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('list.users');
    }
}
