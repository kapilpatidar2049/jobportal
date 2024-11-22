<?php

namespace App\Models\Jobportal;

use App\Models\JobPortalUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobportalCandidate extends Model
{
    use HasFactory;
    protected $fillable=['job_id','user_id','resume_type'];

    public function user(){
        return $this->belongsTo(JobPortalUser::class, 'user_id')->withDefault();
    }
    public function job(){
        return $this->belongsTo(Jobs::class)->withDefault();
    }
}
