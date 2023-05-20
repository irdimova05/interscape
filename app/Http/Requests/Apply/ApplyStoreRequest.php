<?php

namespace App\Http\Requests\Apply;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class ApplyStoreRequest extends MainFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Gate::authorize('apply.ad');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => 'required|file',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'file.required' => 'Моля, прикачете автобиография.',
        ];
    }
}
