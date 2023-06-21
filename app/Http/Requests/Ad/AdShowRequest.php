<?php

namespace App\Http\Requests\Ad;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class AdShowRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('ad.view', $this->route('ad'));
    }
}
