<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations'; // hardcoded because in the doctrine library education is an uncountable word without a plural form

    const BACHELOR = 'bachelor';
    const MASTER = 'master';
    const DOCTORANT = 'doctorant';
    const DOCTOR = 'doctor';

    protected $fillable = [
        'name',
        'slug',
    ];
}
