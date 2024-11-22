<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    use HasFactory;
    protected $tabel = 'job_skills';
    protected $fillable = ['job_id','skill'];
}
