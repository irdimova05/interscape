<?php

namespace App\Http\Requests\Ad;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class AdCreateRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('create.ad');
    }
}