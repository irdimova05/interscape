<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
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
    ];

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function employers()
    {
        return $this->hasMany(Employer::class);
    }
}
