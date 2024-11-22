<?php

namespace App\Models\Jobportal;

use App\Models\JobPortalUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','job_id','status'];

    public function user(){
        return $this->belongsTo(JobPortalUser::class, 'user_id')->withDefault();
    }
    public function job(){
        return $this->belongsTo(Jobs::class)->withDefault();
    }
}
