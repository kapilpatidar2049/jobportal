<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrescreenAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['question_id','user_id','job_id','question','answer','shifts'];
}
