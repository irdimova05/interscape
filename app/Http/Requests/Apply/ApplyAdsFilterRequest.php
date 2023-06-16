<?php

namespace App\Http\Requests\Apply;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class ApplyAdsFilterRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('list.applies');
    }
}
