<?php

namespace App\Http\Requests\Ad;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class AdStatusRequest extends MainFormRequest
{
    public function authorize()
    {
        return Gate::authorize('status.ad', $this->route('ad'));
    }

    public function rules()
    {
        return [];
    }
}
