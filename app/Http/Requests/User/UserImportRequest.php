<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Common\MainFormRequest;
use Gate;

class UserImportRequest extends MainFormRequest
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
            'file' => 'required|file|mimes:xls,xlsx',
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
            'file.required' => 'Файлът е задължителен.',
            'file.file' => 'Невалиден файл.',
            'file.mimes' => 'Невалиден формат на файла.',
        ];
    }
}
