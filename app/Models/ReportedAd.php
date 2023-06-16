<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedAd extends Model
{
    protected $fillable = [
        'student_id',
        'ad_id',
        'reason',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
