<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'university_id',
    ];

    public function specialties()
    {
        return $this->hasMany(Specialty::class);
    }
}
