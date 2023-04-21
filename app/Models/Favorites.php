<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'ad_id',
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
