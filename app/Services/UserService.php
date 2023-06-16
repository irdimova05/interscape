<?php

namespace App\Services;

use App\Models\Status;
use App\Models\User;
use Hash;
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
        $data['password'] = bcrypt($data['password']);

        return User::create($data)
            ->assignRole($data['role']);
    }

    public static function updateUser($user, $request)
    {
        $user = $request->user();

        $user->name = $request->name;
        $user->email = $request->email;
        $photoPath = Storage::url(Storage::disk('public')->putFile('profile_pictures', $request->file('photo')));

        if ($user->isStudent()) {
            $user->student->specialty_id = $request->specialty;
            $user->student->course_id = $request->course;
            $user->student->success = $request->success;
            $user->student->description = $request->description;
            $user->student->save();
        }

        if ($user->isEmployer()) {
            $user->employer->name = $request->name;
            $user->employer->description = $request->description;
            $user->employer->email = $request->email;
            $user->employer->phone = $request->phone;
            $user->employer->address = $request->address;
            $user->employer->website = $request->website;
            $user->employer->logo = $photoPath;
            $user->employer->employee_range_id = $request->employee_range;
            $user->employer->save();
        } else {
            $user->profile_picture = $photoPath;
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
