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

            StudentInterest::firstOrCreate(
                ['student_id' => $student->id, 'employer_id' => $request->employer_id]
            );
        } else if ($user->isEmployer()) {
            $employer = $user->employer;

            EmployerInterest::firstOrCreate(
                ['employer_id' => $employer->id, 'student_id' => $request->student_id]
            );
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
