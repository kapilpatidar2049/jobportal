<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPreference extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id',
        'email',
        'sendmail',
        'contactmail',
        'requirecv',
        'deadline',
        'deadlinetime',
    ];
}
