<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserEditRequest;
use App\Http\Requests\User\UserIndexRequest;
use App\Http\Requests\User\UserSearchRequest;
use App\Http\Requests\User\UserShowRequest;
use App\Http\Requests\User\UserStatusRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Models\Status;
use App\Models\User;
use App\Services\MessageService;
use App\Services\UserService;
use DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserIndexRequest $request)
    {
        $users = UserService::getUsers();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserCreateRequest $request)
    {
        $roles = Role::all()->pluck('name', 'id')->transform(function ($name) {
            return trans("roles.$name");
        });
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            UserService::createUser($request->all());
            MessageService::success('Успешно създадохте потребител!');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            MessageService::error('Възникна грешка при създаването на потребител!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserShowRequest $request, $id)
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
    public function edit(UserEditRequest $request, User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function search(UserSearchRequest $request)
    {
        $users = UserService::getUsers(function ($query) use ($request) {
            return UserService::applySearch($query, $request->get('q'));
        });
        return view('users.components.table', compact('users'));
    }

    public function status(UserStatusRequest $request, User $user)
    {
        $status = Status::where('slug', $request->get('status'))->firstOrFail()->id;
        UserService::updateStatus($user, $status);
        return redirect()->back();
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="template.xlsx"',
        ];

        return response()->download(public_path('templates/template.xlsx'), 'template.xlsx', $headers);
    }

    public function import(UserCreateRequest $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $path = $request->file('file')->getRealPath();
        $result = UserService::importUsers($path);

        return redirect()->back();
    }
}
