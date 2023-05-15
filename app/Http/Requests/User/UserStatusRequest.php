<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class UserStatusRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('status.user');
    }
}
