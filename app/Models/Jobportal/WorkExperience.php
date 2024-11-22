<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'resume_id',
        'job_title',
        'company_name',
        'job_type',
        'city',
        'state',
        'country',
        'start_date',
        'end_date',
        'present',
        'description',
    ];
}
