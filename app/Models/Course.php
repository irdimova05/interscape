<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    const FIRST = 'first';
    const SECOND = 'second';
    const THIRD = 'third';
    const FOURTH = 'fourth';
    const GRADUATED = 'graduated';

    protected $fillable = [
        'name',
        'slug'
    ];
}
