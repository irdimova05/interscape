<?php

namespace App\Services;

use App\Models\Student;

class StudentService
{
    public static function getStudents($callback = null)
    {
        $query = Student::with(
            'user',
            'course:id,name',
            'specialty:id,name',
            'specialty.education:id,name',
            'specialty.faculty:id,name',
            'specialty.faculty.university:id,name',
            'specialty.education:id,name'
        );

        if ($callback) {
            $query = call_user_func($callback, $query);
        }

        $students = $query->paginate(20);

        return $students;
    }
}
