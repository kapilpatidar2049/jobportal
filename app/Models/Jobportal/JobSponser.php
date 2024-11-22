<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSponser extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'duration',
        'customdate',
        'currency',
        'budget',
        'budget_type',
        'addlabel',
    ];
}
