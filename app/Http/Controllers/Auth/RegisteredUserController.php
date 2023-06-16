<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\EmployeeRanges;
use App\Models\Specialty;
use App\Models\University;
use Auth;

class RegisteredUserController extends Controller
{
    public function complete()
    {
        $user = Auth::user();
        $view = view('auth.register-complete');
        if ($user->isStudent()) {
            $user->load('student');
            $view->with('universities', University::pluck('name', 'id')->toArray())
                ->with('specialties', Specialty::pluck('name', 'id')->toArray())
                ->with('courses', Course::pluck('name', 'id')->toArray());
        } else if ($user->isEmployer()) {
            $user->load('employer');
            $view->with('employeeRanges', EmployeeRanges::pluck('range', 'id')->toArray());
        }

        return $view->with('user', $user);
    }
}
