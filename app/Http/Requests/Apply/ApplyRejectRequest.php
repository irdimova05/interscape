<?php

namespace App\Http\Requests\Apply;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class ApplyRejectRequest extends MainFormRequest
{
    public function authorize()
    {
        return Gate::authorize('reject.apply', $this->route('apply'));
    }

    public function rules()
    {
        return [];
    }
}
