<?php

namespace App\Services;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Mail\Email;
use App\Models\Status;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Spatie\Permission\Models\Role;
use Storage;
use Validator;

class UserService
{
    public static function enrichUser(&$user)
    {
        if ($user->relationLoaded('roles')) {
            $roleNames = self::formatUserRoles($user->roles);
            $user->role_names = $roleNames;
        }
    }

    public static function enrichUsers(&$users)
    {
        foreach ($users as &$user) {
            self::enrichUser($user);
        }
    }

    public static function formatUserRoles($roles)
    {
        $roleNames = [];
        foreach ($roles as $role) {
            $roleNames[] = __('roles.' . $role->name);
        }
        return implode(', ', $roleNames);
    }

    public static function getUsers($callback = null)
    {
        $query = User::with('status:id,slug', 'roles')->where('is_profile_completed', '1');

        if ($callback) {
            $query = call_user_func($callback, $query);
        }

        $users = $query->paginate(10);
        self::enrichUsers($users);

        return $users;
    }

    public static function applySearch($query, $search)
    {
        $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('id', $search);

        return $query;
    }

    public static function updateStatus($user, $statusId)
    {
        $user->status_id = $statusId;
        $user->save();
    }

    public static function createUser($data)
    {
        $data['status_id'] = Status::where('slug', Status::INACTIVE)->first()->id;
        $password = $data['password'];
        $data['password'] = bcrypt($password);

        $user = User::create($data)
            ->assignRole($data['role']);

        Mail::to($user)->send(new Email($user, $password));

        return $user;
    }

    public static function updateUser($user, UserUpdateRequest $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('photo')) {
            $photoPath = Storage::url(Storage::disk('public')->putFile('profile_pictures', $request->file('photo')));
        }

        if ($user->isStudent()) {
            if ($request->specialty) {
                $user->student->specialty_id = $request->specialty;
            }

            if ($request->course) {
                $user->student->course_id = $request->course;
            }

            if ($request->success) {
                $user->student->success = $request->success;
            }

            if ($request->description) {
                $user->student->description = $request->description;
            }

            $user->student->save();
        }

        if ($user->isEmployer()) {
            if ($request->employer->name) {
                $user->employer->name = $request->employer->name;
            }

            if ($request->employer->description) {
                $user->employer->description = $request->employer->description;
            }

            if ($request->employer->email) {
                $user->employer->email = $request->employer->email;
            }

            if ($request->employer->phone) {
                $user->employer->phone = $request->employer->phone;
            }

            if ($request->employer->address) {
                $user->employer->address = $request->employer->address;
            }

            if ($request->employer->website) {
                $user->employer->website = $request->employer->website;
            }

            if ($request->employer->logo) {
                $user->employer->logo = $photoPath;
            }

            if ($request->employer->employee_range) {
                $user->employer->employee_range_id = $request->employer->employee_range;
            }
            $user->employer->save();
        } else {
            if ($request->hasFile('photo')) {
                $user->profile_picture = $photoPath;
            }
        }

        $user->save();
    }

    public static function importUsers($filePath)
    {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        $roles = [
            'администратор' => 'admin',
            'студент' => 'student',
            'фирма' => 'employer',
        ];

        $data = $worksheet->rangeToArray('A2:' . $highestColumn . $highestRow, null, true, false);

        $validator = Validator::make($data, [
            '*.0' => 'required|email|unique:users,email',
            '*.1' => 'required|min:8',
            '*.2' =>  [
                'required',
                Rule::in(array_keys($roles)),
            ],
        ]);

        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->all()
            ];
        }

        foreach ($data as $rowData) {
            $user = new User();
            $user->email = $rowData[0];
            $user->password = Hash::make($rowData[1]);
            $user->status_id = Status::where('slug', Status::INACTIVE)->first()->id;
            $role = Role::where('name', $roles[$rowData[2]])->first();
            $user->save();
            $user->assignRole($role);
        }
    }
}
