<?php

namespace App\Http\Requests\ReportedAd;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class ReportedAdUpdateRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('status.report');
    }
}
