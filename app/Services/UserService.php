<?php

namespace App\Services;

class UserService
{
    public static function enrichUsers(&$users)
    {
        foreach ($users as &$user) {
            if ($user->relationLoaded('roles')) {
                $roleNames = self::formatUserRoles($user->roles);
                $user->role_names = $roleNames;
            }
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
}
