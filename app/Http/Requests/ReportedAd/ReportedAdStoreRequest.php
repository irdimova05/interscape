<?php

namespace App\Http\Requests\ReportedAd;

use App\Http\Requests\Common\MainFormRequest;
use Illuminate\Support\Facades\Gate;

class ReportedAdStoreRequest extends MainFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('report.ad');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'reason' => 'required|string',
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
            'reason.required' => 'Моля, посочете причината за докладването на обявата.',
        ];
    }
}
