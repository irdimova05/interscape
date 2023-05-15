<?php

namespace App\Http\Requests\Apply;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class ApplyCreateRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('apply.ad');
    }
}
