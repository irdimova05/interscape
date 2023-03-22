<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyStatus extends Model
{
    use HasFactory;

    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const AWAITING = 'awaiting';

    protected $fillable = [
        'name',
        'slug',
    ];
}
