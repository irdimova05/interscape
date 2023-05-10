<?php

namespace App\Http\Requests\ReportedAd;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class ReportedAdIndexRequest extends MainGetRequest
{
    public function authorize()
    {
        Gate::authorize('list.reported_ad');
    }
}
