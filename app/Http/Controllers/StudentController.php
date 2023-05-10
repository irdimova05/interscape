<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use App\Http\Requests\Student\StudentIndexRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudentIndexRequest $request)
    {
        $students = StudentService::getStudents();

        return view('users.students.index', compact('students'));
    }
}
