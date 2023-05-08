<?php

namespace App\Http\Requests\Ad;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class AdIndexRequest extends MainGetRequest
{
    public function authorize()
    {
        Gate::authorize('list.ad');
    }
}
