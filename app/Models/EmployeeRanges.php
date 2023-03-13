<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRanges extends Model
{
    use HasFactory;

    const RANGE1_50 = "range_1_50";
    const RANGE51_100 = "range_51_100";
    const RANGE101_500 = "range_101_500";
    const RANGEOVER500 = "range_over_500";

    protected $fillable = [
        'range',
        'slug',
    ];
}
