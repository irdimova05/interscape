<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employer\EmployerIndexRequest;
use App\Services\EmployerService;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployerIndexRequest $request)
    {
        $employers = EmployerService::getEmployers();

        return view('users.employers.index', compact('employers'));
    }
}
