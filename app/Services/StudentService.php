<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Status;
use App\Models\Student;

class StudentService
{
    public static function getStudents($callback = null)
    {
        $query = Student::with(
            'user',
            'course',
            'specialty',
            'specialty.education',
            'specialty.faculty',
            'specialty.faculty.university',
            'specialty.education',
            'user.status',
        );

        if (auth()->user()->hasRole('employer')) {
            $query->whereHas('user.status', function ($q) {
                $q->where('slug', Status::ACTIVE);
            });
        }

        if ($callback) {
            $query = call_user_func($callback, $query);
        }

        $students = $query->paginate(10);

        return $students;
    }
}
