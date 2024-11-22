<?php

namespace App\Models\Jobportal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildResume extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image',
        'name',
        'contry_code',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'country',
        'achievements',
    ];
}
