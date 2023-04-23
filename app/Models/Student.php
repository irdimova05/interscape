<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'success',
        'description',
        'specialty_id',
        'course_id',
        'user_id',
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applies()
    {
        return $this->hasMany(Apply::class);
    }

    public function interests()
    {
        return $this->hasMany(StudentInterest::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function hasAdInFavorite($adId)
    {
        return $this->favorite()->where('ad_id', $adId)->exists();
    }

    public function getFavoriteByAd($adId)
    {
        return $this->favorite()->where('ad_id', $adId)->first();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
