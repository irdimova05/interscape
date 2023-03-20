<?php

namespace App\Services;

use App\Models\Employer;
use App\Models\Status;

class EmployerService
{
    public static function getEmployers($callback = null)
    {
        $query = Employer::with(
            'employeeRange',
            'user.status',
        );

        if (auth()->user()->hasRole('student')) {
            $query->whereHas('user.status', function ($q) {
                $q->where('slug', Status::ACTIVE);
            });
        }

        if ($callback) {
            $query = call_user_func($callback, $query);
        }

        $employers = $query->paginate(10);

        self::enrichEmployer($employers);

        return $employers;
    }

    public static function enrichEmployer(&$employer)
    {
        if ($employer->relationLoaded('employeeRange')) {
            $employer->employeeRange->name . ' служители';
        }
    }

    public static function enrichEmployers(&$employers)
    {
        foreach ($employers as &$employer) {
            self::enrichEmployer($employer);
        }
    }
}
