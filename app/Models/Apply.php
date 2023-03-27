<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'user_id',
        'file_id',
        'description',
        'apply_status_id',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applyStatus()
    {
        return $this->belongsTo(ApplyStatus::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
