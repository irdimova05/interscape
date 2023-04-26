<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'phone' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            'employee_ranges' => 'required|integer|exists:employee_ranges,id',
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
            'photo.required' => 'Снимката е задължителна.',
            'photo.image' => 'Невалидна снимка.',
            'photo.mimes' => 'Невалиден формат на снимката.',
            'photo.max' => 'Снимката трябва да бъде по-малка от 2MB.',
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
            'employee_ranges_id.required' => 'Размерът на фирмата е задължителен.',
            'employee_ranges_id.integer' => 'Невалиден размер на фирмата.',
            'employee_ranges_id.exists' => 'Невалиден размер на фирмата.',
        ];
    }
}
