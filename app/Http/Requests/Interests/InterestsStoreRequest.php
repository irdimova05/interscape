<?php

namespace App\Http\Requests\Interests;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class InterestsStoreRequest extends MainFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('create.interests');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [];
    }
}
