<?php

namespace App\Services;

use App\Models\EmployerInterest;
use App\Models\StudentInterest;

class InterestService
{
    public static function createInterest($request)
    {
        /** @var User $user */
        $user = auth()->user();
        if ($user->isStudent()) {
            $student = $user->student;

            $interest = new StudentInterest();
            $interest->student_id = $student->id;
            $interest->employer_id = $request->employer_id;
            $interest->save();
        } else if ($user->isEmployer()) {
            $employer = $user->employer;

            $interest = new EmployerInterest();
            $interest->employer_id = $employer->id;
            $interest->student_id = $request->student_id;
            $interest->save();
        }
    }

    public static function getInterests()
    {

        /** @var User $user */
        $user = auth()->user();
        if ($user->isStudent()) {
            return EmployerInterest::where('student_id', $user->student->id)
                ->with('employer')
                ->paginate(10);
        } else if ($user->isEmployer()) {
            return StudentInterest::where('employer_id', $user->employer->id)
                ->with('student')
                ->paginate(10);
        }
    }
}
