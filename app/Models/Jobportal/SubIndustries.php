<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubIndustries extends Model
{
    use HasFactory;
    protected $fillable = [
        'industry_id',
        'name',
    ];
}
