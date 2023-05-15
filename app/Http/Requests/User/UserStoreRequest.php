<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\MainFormRequest;
use Gate;

class UserStoreRequest extends MainFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('create.user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|integer|exists:roles,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'email.required' => 'Имейлът е задължителен.',
            'email.email' => 'Невалиден имейл.',
            'email.unique' => 'Вече съществува потребител с този имейл.',
            'password.required' => 'Паролата е задължителна.',
            'password.string' => 'Невалидна парола.',
            'password.min' => 'Паролата трябва да бъде поне 8 символа.',
            'role.required' => 'Ролята е задължителна.',
        ];
    }
}
