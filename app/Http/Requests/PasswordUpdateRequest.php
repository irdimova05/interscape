<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasswordUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'sometimes|required_with:password|string|min:8|current_password',
            'password' => 'sometimes|required_with:current_password|string|min:8|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'current_password.required_with' => 'Текущата парола е задължителна.',
            'current_password.string' => 'Невалидна текуща парола.',
            'current_password.min' => 'Текущата парола трябва да бъде поне 8 символа.',
            'current_password.current_password' => 'Невалидна текуща парола.',
            'password.required_with' => 'Паролата е задължителна.',
            'password.string' => 'Невалидна парола.',
            'password.min' => 'Паролата трябва да бъде поне 8 символа.',
            'password_confirmation.confirm' => 'Паролите не съвпадат.',
            'password.different' => 'Новата парола не може да бъде като старата.',
        ];
    }
}
