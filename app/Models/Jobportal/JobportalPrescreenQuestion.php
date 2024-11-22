<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobportalPrescreenQuestion extends Model
{
    use HasFactory;

    protected $table = 'jobportal_prescreen_questions';

    protected $fillable = [
        'job_id',
        'type',
        'education',
        'year',
        'field',
        'language',
        'certificate',
        'location',
        'shift',
        'travel',
        'custom_question'
    ];

    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_id')->withDefault();
    }
}
