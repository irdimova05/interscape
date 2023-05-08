<?php

namespace App\Http\Requests\Employer;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class EmployerIndexRequest extends MainGetRequest
{
    public function authorize()
    {
        Gate::authorize('list.employer');
    }
}
