<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'faculty_id',
        'education_id',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}
