<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'resume_id',
        'degree',
        'specialization',
        'insitution',
        'year_of_passing',
        'percentage',
        'start_date',
        'end_date',
    ];
}
