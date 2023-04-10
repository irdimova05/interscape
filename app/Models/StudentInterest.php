<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInterest extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'employer_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
