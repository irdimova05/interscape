<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class ReportAdUpdateRequest extends MainGetRequest
{
    public function authorize()
    {
        Gate::authorize('update.reported_ad');
    }
}
