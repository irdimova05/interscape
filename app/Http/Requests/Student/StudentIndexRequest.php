<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\Common\MainGetRequest;
use Illuminate\Support\Facades\Gate;

class StudentIndexRequest extends MainGetRequest
{
    public function authorize()
    {
        return Gate::authorize('list.student');
    }
}
