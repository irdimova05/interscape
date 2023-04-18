<?php

namespace App\Services;

use App\Models\Status;
use App\Models\User;
use Hash;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Spatie\Permission\Models\Role;
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
        $query = User::with('status:id,slug', 'roles');

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
