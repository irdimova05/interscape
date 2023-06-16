<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class UserStatusRequest extends MainFormRequest
{
    public function authorize()
    {
        return Gate::authorize('status.user', $this->route('user'));
    }

    public function rules(): array
    {
        return [];
    }
}
