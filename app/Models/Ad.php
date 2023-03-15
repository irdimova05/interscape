<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'employer_id',
        'ad_status_id',
        'ad_category_id',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function adStatus()
    {
        return $this->belongsTo(AdStatus::class);
    }

    public function adCategory()
    {
        return $this->belongsTo(AdCategory::class);
    }
}
