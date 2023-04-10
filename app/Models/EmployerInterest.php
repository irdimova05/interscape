<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerInterest extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'employer_id',
        'student_id',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
