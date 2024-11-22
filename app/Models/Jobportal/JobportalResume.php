<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobportalResume extends Model
{
    use HasFactory;
    protected $fillable=['user_id','resume','status'];
}
