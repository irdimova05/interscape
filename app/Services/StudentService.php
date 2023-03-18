<?php

namespace App\Services;

use App\Models\Course;
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

        if ($callback) {
            $query = call_user_func($callback, $query);
        }

        $students = $query->paginate(10);

        self::enrichStudents($students);

        return $students;
    }

    public static function enrichStudent(&$student)
    {
        if ($student->relationLoaded('course')) {
            if ($student->course->slug !== Course::GRADUATED) {
                $student->course->name_formatted = $student->course->name . ' курс';
            } else {
                $student->course->name_formatted = $student->course->name;
            }
        }
    }

    public static function enrichStudents(&$students)
    {
        foreach ($students as &$student) {
            self::enrichStudent($student);
        }
    }
}
