<?php

namespace App\Http\Requests\Ad;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class AdStoreRequest extends MainFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('create.ad');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'jobType' => 'required|integer|exists:job_types,id',
            'salary' => 'integer|min:0',
            'category' => 'required|integer|exists:ad_categories,id',
            'description' => 'required|string',
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
            'title.required' => 'Заглавието е задължително поле.',
            'title.max' => 'Заглавието не може да бъде по-голямо от 50 символа.',
            'salary.integer' => 'Заплатата трябва да бъде цяло число.',
            'salary.min' => 'Заплатата не може да бъде по-малка от 0.',
            'description.required' => 'Описанието е задължително поле.',
        ];
    }
}