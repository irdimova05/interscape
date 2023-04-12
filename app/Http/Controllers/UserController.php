<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Status;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserService::getUsers();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id')->transform(function ($name) {
            return trans("roles.$name");
        });
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = UserService::createUser($request->all());
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('status:id,slug', 'roles')->findOrFail($id);
        UserService::enrichUser($user);
        if ($user->isStudent()) {
            $user->load('student.course', 'student.specialty.education', 'student.specialty.faculty.university');
            return view('users.students.show', compact('user'));
        } else if ($user->isEmployer()) {
            $user->load('employer.ads');
            return view('users.employers.show', compact('user'));
        } else if ($user->isAdmin()) {
            return view('users.admins.show', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $users = UserService::getUsers(function ($query) use ($request) {
            return UserService::applySearch($query, $request->get('q'));
        });
        return view('users.components.table', compact('users'));
    }

    public function status(Request $request, User $user)
    {
        $status = Status::where('slug', $request->get('status'))->firstOrFail()->id;
        UserService::updateStatus($user, $status);
        return redirect()->back();
    }
}
