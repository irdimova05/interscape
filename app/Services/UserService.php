<?php

namespace App\Services;

use App\Models\User;

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
}
