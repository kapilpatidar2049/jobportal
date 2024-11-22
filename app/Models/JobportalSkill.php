<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobportalSkill extends Model
{
    use HasFactory;
    protected $table = 'jobportal_skills';
    protected $fillable = ['skill'];
}
