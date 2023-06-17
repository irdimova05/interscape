<?php

namespace App\Http\Requests\Common;

use Illuminate\Http\Request;

abstract class MainGetRequest extends Request
{
    public function __construct()
    {
        $baseRequest = request();
        parent::__construct(
            $baseRequest->query->all(),
            $baseRequest->request->all(),
            $baseRequest->attributes->all(),
            $baseRequest->cookies->all(),
            $baseRequest->files->all(),
            $baseRequest->server->all()
        );

        $this->setUserResolver($baseRequest->getUserResolver());

        $this->setRouteResolver($baseRequest->getRouteResolver());

        $this->authorize();
    }

    abstract public function authorize();
}
