<?php

namespace App\Http\Requests\Common;

use Illuminate\Http\Request;

abstract class MainGetRequest extends Request
{
    public function __construct()
    {
        parent::__construct();
        $this->authorize();
    }

    abstract public function authorize();
}
