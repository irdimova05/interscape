<?php

namespace App\Http\Requests\Ad;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class AdBlockRequest extends MainFormRequest
{
    public function authorize()
    {
        return Gate::authorize('block.ad', $this->route('ad'));
    }

    public function rules()
    {
        return [];
    }
}
