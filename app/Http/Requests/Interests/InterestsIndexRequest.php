<?php

namespace App\Http\Requests\Interests;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class InterestsIndexRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('list.interests');
    }
}
