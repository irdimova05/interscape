<?php

namespace App\Http\Requests\ReportedAd;

use App\Http\Requests\Common\MainFormRequest;
use App\Models\ReportedAd;
use Illuminate\Support\Facades\Gate;
use Route;

class ReportedAdUpdateRequest extends MainFormRequest
{
    public function authorize()
    {
        return Gate::authorize('status.report', [$this->route('ad')]);
    }

    public function rules()
    {
        return [];
    }
}
