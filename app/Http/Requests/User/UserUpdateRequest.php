<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'description' => 'required|string',
        ];

        if ($this->user()->hasRole('student')) {
            $rules = array_merge($rules, $this->getStudentRules());
        } elseif ($this->user()->hasRole('employer')) {
            $rules = array_merge($rules, $this->getEmployerRules());
        }

        return $rules;
    }

    private function getStudentRules(): array
    {
        return [
            'success' => 'required|numeric|min:2|max:6',
            'specialty' => 'required|integer|exists:specialties,id',
            'course' => 'required|integer|exists:courses,id',
        ];
    }

    private function getEmployerRules(): array
    {
        return [
            'address' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'employee_range' => 'required|integer|exists:employee_ranges,id',
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
            'name.required' => 'Името е задължително.',
            'name.string' => 'Невалидно име.',
            'name.max' => 'Името трябва да бъде по-малко от 255 символа.',
            'email.required' => 'Имейлът е задължителен.',
            'email.email' => 'Невалиден имейл.',
            'email.unique' => 'Вече съществува потребител с този имейл.',
            'description.required' => 'Описанието е задължително.',
            'description.string' => 'Невалидно описание.',
            // 'photo.required' => 'Снимката е задължителна.',
            // 'photo.image' => 'Невалиден формат на снимката.',
            // 'photo.max' => 'Снимката трябва да бъде по-малка от 2MB.',
            'success.required' => 'Успехът е задължителен.',
            'success.numeric' => 'Невалиден успех.',
            'success.min' => 'Успехът трябва да бъде поне 2.',
            'success.max' => 'Успехът трябва да бъде най-много 6.',
            'specialty.required' => 'Специалността е задължителна.',
            'specialty.integer' => 'Невалидна специалност.',
            'specialty.exists' => 'Невалидна специалност.',
            'course.required' => 'Курсът е задължителен.',
            'course.integer' => 'Невалиден курс.',
            'course.exists' => 'Невалиден курс.',
            'phone.required' => 'Телефонът е задължителен.',
            'phone.string' => 'Невалиден телефон.',
            'phone.max' => 'Телефонът трябва да бъде по-малко от 10 символа.',
            'address.required' => 'Адресът е задължителен.',
            'address.string' => 'Невалиден адрес.',
            'address.max' => 'Адресът трябва да бъде по-малко от 255 символа.',
            'website.required' => 'Уебсайтът е задължителен.',
            'website.string' => 'Невалиден уебсайт.',
            'website.max' => 'Уебсайтът трябва да бъде по-малко от 255 символа.',
            'employee_range.required' => 'Размерът на фирмата е задължителен.',
            'employee_range.integer' => 'Невалиден размер на фирмата.',
            'employee_range.exists' => 'Невалиден размер на фирмата.',
            'current_password.required_with' => 'Текущата парола е задължителна.',
            'current_password.string' => 'Невалидна текуща парола.',
            'current_password.min' => 'Текущата парола трябва да бъде поне 8 символа.',
            'current_password.current_password' => 'Невалидна текуща парола.',
            'password.required_with' => 'Паролата е задължителна.',
            'password.string' => 'Невалидна парола.',
            'password.min' => 'Паролата трябва да бъде поне 8 символа.',
            'password.confirmed' => 'Паролите не съвпадат.',
            'description.required' => 'Описанието е задължително.',
        ];
    }
}
