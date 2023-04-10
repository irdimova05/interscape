<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'email',
        'phone',
        'address',
        'website',
        'logo',
        'user_id',
        'employee_ranges_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function employeeRange()
    {
        return $this->belongsTo(EmployeeRanges::class);
    }

    public function interests()
    {
        return $this->hasMany(EmployerInterest::class);
    }
}
