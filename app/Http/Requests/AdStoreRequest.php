<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();

        return $user->can('create.ad');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'jobType' => 'required|integer|exists:job_types,id',
            'salary' => 'required|integer|min:0',
            'category' => 'required|integer|exists:ad_categories,id',
            'description' => 'required|string',
        ];
    }
}
