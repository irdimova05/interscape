<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    protected $fillable = [
        'name',
        'slug'
    ];

}
