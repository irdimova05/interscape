<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Http\Request;

class AdCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    }
}
