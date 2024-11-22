<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoIntrestJob extends Model
{
    use HasFactory;
    protected $fillable = ['job_id','user_id'];
}
