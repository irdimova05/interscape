<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmployeeRanges;
use Auth;

class RegisteredUserController extends Controller
{
    public function complete()
    {
        $user = Auth::user();
        $view = view('auth.register-complete');
        if ($user->isStudent()) {
            $user->load('student');
        } else if ($user->isEmployer()) {
            $user->load('employer');
            $view->with('employeeRanges', EmployeeRanges::pluck('range', 'id')->toArray());
        }

        return $view->with('user', $user);
    }
}
